<style>
    .button {
        background-color: #008CBA;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
</style>
<form action="createDatabase.php" method="post">
    <input class='button' type="submit" value="Create Database">
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once '../app/Database/MySqlResult.php';
    require_once '../app/Database/TextLogger.php';
    require_once '../app/Database/MySqlDb.php';
    require_once '../app/DbConfig.php';
    require_once './CommunityDatabaseCreator.php';
    $db = DbConfig::getInstance();
    if($db->databaseDoesNotExists()){
        $creator = new CommunityDatabaseCreator($db);
        $creator->create();
    }
}

echo "<br><br>";
echo "<a class='button' href='/CommunityLeaderBoards/public/'>Login</a>";