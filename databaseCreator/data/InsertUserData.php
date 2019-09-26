<?php
require_once '../../../Database lab # 1-20180824/MySQLDB.php';
$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'community';
$db = new MySQL($host, $dbUser, $dbPass, $dbName);
$db->selectDatabase();
$uid = 1001;
if (($handle = fopen("./MOCK_DATA.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $firstName = mysqli_real_escape_string($db->dbConn,$data[1]);
        $lastName = mysqli_real_escape_string($db->dbConn,$data[2]);
        $email = $data[3];
        $gender = $data[4];
        $country = $data[5];
        $sql = "insert into user (firstName, lastName, email, gender,country)
                values ('$firstName','$lastName','$email','$gender','$country')";
        $db->query($sql);
        $userName = $data[6];
        $password = password_hash($data[7], PASSWORD_DEFAULT);
        $sql = "insert into loginInfo (userId,username,password) value ($uid, '$userName', '$password')";
        $db->query($sql);
        $uid++;
    }
    fclose($handle);
}