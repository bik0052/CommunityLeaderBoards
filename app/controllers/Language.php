<?php

class Language
{
    public function index($language)
    {
        if($language == 'en'){
            SessionManager::set('lang',$language);
        }else if ($language == 'hi'){
            SessionManager::set('lang',$language);
        }
        $address = $_SERVER['HTTP_REFERER'];
        header("Location: $address");
    }
}