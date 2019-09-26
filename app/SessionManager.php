<?php

class SessionManager
{
    public static function startSession()
    {
        if(SessionManager::sessionIsNotActive()){
            session_start();
        }
        session_regenerate_id();
        SessionManager::validateSession();
    }

    public static function validateSession()
    {
        if(SessionManager::keyExists('lastActivity') && (time() - SessionManager::get('lastActivity')) > 900)
        {
            SessionManager::clear();
            Utility::redirect('/CommunityLeaderBoards/public/');
        }
        SessionManager::set('lastActivity', time());
    }

    public static function get($key)
    {
        if(SessionManager::keyExists($key)) {
            return $_SESSION[$key];
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function showSession(){
        Utility::display($_SESSION);
    }

    protected static function sessionIsNotActive()
    {
        return session_status() == 1;
    }

    protected static function keyExists($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function clear()
    {
        foreach ($_SESSION as $key=>$value) {
            unset($_SESSION [$key]);
        }
        session_destroy();
    }
}