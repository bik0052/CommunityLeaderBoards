<?php

require_once('models/LoginModel.php');
require_once('models/SignUpModel.php');
require_once('DbConfig.php');
require_once('core/App.php');
require_once('core/Controller.php');
require_once('controllers/Login.php');
require_once('controllers/Community.php');
require_once('models/CommunityModel.php');
require_once('models/CommunityUpdateModel.php');
require_once('models/TheseusAndTheMinotaurUpdateModel.php');
require_once('Security.php');
require_once('Utility.php');
require_once('SessionManager.php');
require_once('Database/TextLogger.php');
require_once 'Database/MySqlResult.php';
require_once('Database/MySqlDb.php');
require_once('views/langConfig.php');
const BASE_URL = '/CommunityLeaderBoards/public/';