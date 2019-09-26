<?php

class CommunityDatabaseCreator
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create()
    {
        $this->db->createDatabase();
        $this->db->selectDatabase();
        $this->createTableUser();
        $this->createTableLoginInfo();
        $this->createTableGameLevel();
        $this->createTableGameLeaderBoard();
        $this->createTableHindiLevel();
        $this->createTableHindiLeaderBoard();
        $this->insertDataTableUserAndLoginInfo();
        $this->insertDataTableGameLevel();
        $this->insertDataTableGameLeaderBoard();
        $this->insertDataTableHindiLevel();
        $this->insertDataTableHindiLeaderBoard();
    }

    private function createTableUser()
    {
        $sql = "Drop table if exists user;";
        $this->db->query($sql);
        $sql = "CREATE TABLE user
                (
                userID int auto_increment PRIMARY KEY,
                firstName varchar(30),
                lastName varchar(30),
                email varchar(50),
                gender varchar(10),
                country varchar(20)
                ) engine=innoDB auto_increment=1001;";
        $this->db->query($sql);
    }

    private function createTableLoginInfo()
    {
        $sql = "Drop table if exists loginInfo;";
        $this->db->query($sql);
        $sql = "CREATE TABLE loginInfo
                (
                userID int unique,
                username varchar(20),
                password varchar(255),
                Foreign Key (userID) references user (userID)
                ) engine=innoDB;";
        $this->db->query($sql);
    }

    private function createTableGameLevel()
    {
        $sql = "Drop table if exists gameLevel;";
        $this->db->query($sql);
        $sql = "CREATE TABLE gameLevel
                (
                levelID int auto_increment PRIMARY KEY,
                levelName varchar(20)
                ) engine=innoDB auto_increment=101;";
        $this->db->query($sql);
    }

    private function createTableGameLeaderBoard()
    {
        $sql = "Drop table if exists gameLeaderBoard;";
        $this->db->query($sql);
        $sql = "CREATE TABLE gameLeaderBoard
                (
                levelID int,
                userID int,
                score int,
                primary key(levelID, userID),
                Foreign Key (levelID) references gameLevel (levelID),
                Foreign Key (userID) references user (userID)
                ) engine=innoDB;";
        $this->db->query($sql);
    }

    private function createTableHindiLevel()
    {
        $sql = "Drop table if exists hindiLevel;";
        $this->db->query($sql);
        $sql = "CREATE TABLE hindiLevel
                (
                levelID int auto_increment PRIMARY KEY,
                levelName varchar(20)
                ) engine=innoDB auto_increment=201;";
        $this->db->query($sql);
    }

    private function createTableHindiLeaderBoard()
    {
        $sql = "Drop table if exists hindiLeaderBoard;";
        $this->db->query($sql);
        $sql = "CREATE TABLE hindiLeaderBoard
                (
                levelID int,
                userID int,
                score int,
                primary key(levelID, userID),
                Foreign Key (levelID) references hindiLevel (levelID),
                Foreign Key (userID) references user (userID)
                ) engine=innoDB;";
        $this->db->query($sql);
    }

    private function insertDataTableUserAndLoginInfo()
    {
        $uid = 1001;
        if (($handle = fopen("./data/userData.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $firstName = mysqli_real_escape_string($this->db->dbConn, $data[0]);
                $lastName = mysqli_real_escape_string($this->db->dbConn, $data[1]);
                $email = $data[2];
                $gender = $data[3];
                $country = $data[4];
                $sql = "insert into user values (null, '$firstName','$lastName','$email','$gender','$country')";
                echo $sql . "\n";
                $this->db->query($sql);
                $userName = $data[5];
                $password = password_hash($userName . $data[6], PASSWORD_DEFAULT);
                $sql = "insert into loginInfo (userID,username,password) value ($uid, '$userName', '$password')";
                echo $sql . "\n";
                $this->db->query($sql);
                $uid++;
            }
            fclose($handle);
        }
    }

    private function insertDataTableGameLevel()
    {
        if (($handle = fopen("./data/gameLevel.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $levelName = mysqli_real_escape_string($this->db->dbConn, $data[0]);
                $sql = "insert into gameLevel values (null,'$levelName')";
                $this->db->query($sql);
            }
            fclose($handle);
        }
    }

    private function insertDataTableGameLeaderBoard()
    {
        if (($handle = fopen("./data/gameLeaderboard.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $levelID = $data[0];
                $userID = $data[1];
                $score = $data[2];
                $sql = "insert into gameLeaderboard (levelID, userID, score)
                values ($levelID,$userID,$score)";
                $this->db->query($sql);
            }
            fclose($handle);
        }
    }

    private function insertDataTableHindiLevel()
    {
        if (($handle = fopen("./data/hindiLevel.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $levelName = mysqli_real_escape_string($this->db->dbConn, $data[0]);
                $sql = "insert into hindiLevel values (null,'$levelName')";
                $this->db->query($sql);
            }
            fclose($handle);
        }
    }

    private function insertDataTableHindiLeaderBoard()
    {
        if (($handle = fopen("./data/hindiLeaderboard.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $levelID = $data[0];
                $userID = $data[1];
                $score = $data[2];
                $sql = "insert into hindiLeaderboard (levelID, userID, score)
                values ($levelID,$userID,$score)";
                $this->db->query($sql);
            }
            fclose($handle);
        }
    }
}

// Game LeaderBoard
// Level 1 = Limiting top player rankings = 1
// Level 2 = Insufficient player rankings = 2
// Level 1 = Unlimited active player rankings = 3
// Level 4 = User ranked outside of top rankings = 4
// Level 5 = No attempts made by any player = 5

// Hindi LeaderBoard
// Level 1 = Limiting top player rankings = 1
// Level 2 = Insufficient player rankings = 2
// Level 1 = Unlimited active player rankings = 3
// Level 1 = User ranked outside of top rankings = 4
// Level 3 = No attempts made by any player = 5

//Require Fix
//10Th rank error.
//Combining View.

//require_once 'MySqlDb.php';
//$mdb = new MySqlDb('localhost', 'root', '', 'Community');
//$b = new CommunityDatabaseCreator($mdb);
//$b->create();