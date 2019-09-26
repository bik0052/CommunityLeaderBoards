<?php

class Controller
{
    protected function getModel($model)
    {
        Utility::getPage("../app/models/$model");
    }

    protected  function getView($view, $data=[])
    {
        Utility::getPage("../app/views/$view", $data);
    }
}