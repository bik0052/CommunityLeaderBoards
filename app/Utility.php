<?php

class Utility
{
    public static function userIsLoggedIn()
    {
        $loggedin = SessionManager::get('loggedin');
        return (!empty($loggedin) && $loggedin === true);
    }
	
    public static function redirect($newLocation)
    {
        header("location: $newLocation");
        exit;
    }

    public static function getPage($newLocation, $data=[])
    {
        require_once($newLocation. '.php');
    }

    public static function sanitiseOutput($newData)
    {
        echo htmlspecialchars($newData);
    }

    public static function getNewPath($path)
    {
        return BASE_URL . $path;
    }

    public static function display($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '<pre>';
    }
}