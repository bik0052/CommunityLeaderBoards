<?php

Abstract class CommunityUpdateModel
{
    protected $db;
    protected $score;
    protected $scoreErr;
    protected $level;
    protected $levelID;
    protected $userID;
    protected $updateSuccessful;
    protected $leaderBoardName;

    public function __construct(iSql $db)
    {
        $this->db = $db;
        $this->updateSuccessful = false;
        $this->setScore();
        $this->setLevel();
        $this->setBoardID();
        $this->setUserID();
        $this->leaderBoardName = $this::LEADERBOARD;
    }

    private function setScore()
    {
        $score = (int)trim($_POST['score']);
        if (empty($score)) {
            $this->scoreErr = 'Please Enter a Score between 1 and 100';
        } elseif ($score < 1 || $score > 100) {
            $this->scoreErr = 'Invalid Score! Please Enter a Score between 1 and 100';
        } else {
            $this->score = $score;
        }
    }

    private function setLevel()
    {
        $this->level = $_POST['maze'];
    }

    private function setBoardID()
    {
        $this->levelID = (int)$_POST['boardID'];
    }

    private function setUserID()
    {
        $this->userID = SessionManager::get('id');
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function updateSuccess()
    {
        if (empty($this->scoreErr)) {
            $this->insertData();
        }
        return $this->updateSuccessful;
    }

    private function insertData()
    {
        $this->db->selectDatabase();
        if ($this->userHaveAScore()) {
            $this->updateScore();
        } else {
            $this->addNewScore();
        }
        $this->updateSuccessful = true;
    }

    protected function userHaveAScore()
    {
        $sql = "select score
        from $this->leaderBoardName
        where userID = $this->userID and levelID = $this->levelID;";
        $result = $this->db->query($sql);
        return $result->size() == 1;
    }

    protected function updateScore()
    {
        $sql = "UPDATE $this->leaderBoardName
        SET score = $this->score
        WHERE userID = $this->userID and levelID = $this->levelID;";
        $this->db->query($sql);
    }

    protected function addNewScore()
    {
        $sql = "insert into $this->leaderBoardName values($this->levelID, $this->userID, $this->score) ";
        $this->db->query($sql);
    }

}