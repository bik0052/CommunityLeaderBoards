<?php
//	session_start();
//
//	if (!isset($_SESSION['lang']))
//		$_SESSION['lang'] = "en";
//	else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
//		if ($_GET['lang'] == "en")
//			$_SESSION['lang'] = "en";
//		else if ($_GET['lang'] == "bs")
//			$_SESSION['lang'] = "bs";
//	}
//	require_once "languages/" . $_SESSION['lang'] . ".php";
SessionManager::startSession();
if (SessionManager::get('lang') == null)
    SessionManager::set('lang','en');
require_once("languages/" . SessionManager::get('lang') . ".php");