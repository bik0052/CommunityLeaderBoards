<?php
require_once '../../../Database lab # 1-20180824/MySQLDB.php';
$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'community';
$db = new MySQL($host, $dbUser, $dbPass, $dbName);
$db->selectDatabase();
$uid = 1001;
if (($handle = fopen("./tamLevel.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $boardId = $data[0];
        $userId = $data[1];
        $score = $data[2];
        $sql = "insert into tamleaderboard (boardId, userId, score)
                values ($boardId,$userId,$score)";
        $db->query($sql);
    }
    fclose($handle);
}