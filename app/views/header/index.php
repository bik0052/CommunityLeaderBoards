<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php //echo $lang['title'] ?></title>
    <link rel="stylesheet" href="/CommunityLeaderBoards/public/bootstrap-4.0.0-dist/css/bootstrap.min.css"
          type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        .footer {
            left: 0;
            position: fixed;
            bottom: 0;
            text-align: center;
            color: white;
            width: 100%;
        }
        .username{
            color: #fff !important;
        }
        .fa-user{
            margin-top: 4px;
        }
        .footer-p-3{
            padding: 1.2rem!important;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="<?php echo $data['active'] == 'Home' ? 'nav-item active' : 'nav-item' ?>">
            <a class="nav-link"
               href="<?php echo Utility::getNewPath('Home/') ?>"><?php echo $GLOBALS['lang']['home'] ?></a>
        </li>
        <li class="<?php echo $data['active'] == 'TaM' ? 'nav-item active' : 'nav-item' ?>">
            <a class="nav-link"
               href="<?php echo Utility::getNewPath('TheseusAndTheMinotaur/Beginner') ?>"><?php echo $GLOBALS['lang']['theseusAndTheMinotaur'] ?></a>
        </li>
        <li class="<?php echo $data['active'] == 'Hindi' ? 'nav-item active' : 'nav-item' ?>">
            <a class="nav-link"
               href="<?php echo Utility::getNewPath('HindiLearning/Beginner') ?>"><?php echo $GLOBALS['lang']['hindi'] ?></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <i class="fa fa-user nav-item nav-link username"></i>
        <i class="nav-item nav-link username"><?php echo Security::sanitise(SessionManager::get('firstName'))?></i>
        <li class="nav-item nav-link username">|</li>
        <li class="nav-item">
            <a class="nav-link username"
               href="<?php echo Utility::getNewPath('Logout/') ?> "><?php echo $GLOBALS['lang']['logout'] ?></a>
        </li>
    </ul>
</nav>