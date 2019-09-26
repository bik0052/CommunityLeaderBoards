<?php
require_once 'iCommunityController.php';
Abstract class Community extends Controller implements iCommunityController
{

    protected $model;
    protected $params;

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setModel($this::UPDATE_MODEL);
            $this->processUpdate();
        }
    }

    private function setModel($model)
    {
        $this->getModel($model);
        $this->model = new $model(DbConfig::getInstance());
    }

    private function processUpdate(): void
    {
        if (!$this->model->updateSuccess()) {
            $this->params['scoreErr'] = $this->model->scoreErr;
        }
        $this->index($this->model->level);
    }

    public function index($level = 'Beginner', $whichPlayers = null)
    {
        $this->setModel($this::LOGIC_MODEL);
        $this->setParameters($level, $whichPlayers);
        $this->goToView($this::ACTIVE_COMMUNITY, $this::VIEW);
    }

    private function setParameters($level, $whichPlayers)
    {
        $this->params['boardID'] = $this->model->getLevelID($level);
        $this->params['topPlayers'] = $this->model->getPlayers($level, $whichPlayers);
        $this->params['active'] = $level;
        $this->params['activeOption'] = $whichPlayers;
        $this->params['path'] = get_class($this) . "/$level/";
    }

    private function goToView($active, $view): void
    {
        $this->getView('Header/index', ['active' => $active]);
        $this->getView($view, $this->params);
    }
}