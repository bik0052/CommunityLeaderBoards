<?php

require_once 'iCommunityModel.php';
Abstract class CommunityModel implements iCommunityModel
{
    public $name;
    protected $db;
    protected $rankedPlayers;

    public function __construct(iSql $db)
    {
        $this->db = $db;
    }

    public function getPlayers($level, $whichPlayers)
    {
        $allRankedPlayers = $this->rankPlayers($this->getAllPlayer($level));
        if ($whichPlayers != null) {
            $function = "get$whichPlayers";
            $this->$function($allRankedPlayers);
        } else {
            $this->getTopTenPlayers($allRankedPlayers);
        }
        return $this->rankedPlayers;
    }

    protected function rankPlayers($allPlayers)
    {
        $rank = 0;
        $previousPoint = 0;
        $players = [];
        while ($row = $allPlayers->fetch()) {
            $player = $row['username'];
            $score = $row['score'];
            $country = $row['country'];
            $rank = ($previousPoint == $score) ? $rank : $rank + 1;
            $previousPoint = $score;
            $players[] = ['rank' => $rank, 'player' => $player, 'score' => $score, 'country' => $country];
        }
        return $players;
    }

    protected function getAllPlayer($level)
    {
        $leaderBoardName = $this::LEADERBOARD;
        $levelName = $this::LEVEL;
        $sql = "
        select username, score, country
        from $leaderBoardName
        inner join $levelName on $leaderBoardName.levelID = $levelName.levelID
        inner join user on $leaderBoardName.userID = user.userID
        inner join loginInfo on user.userID = loginInfo.userID
        where $levelName.levelName = '$level'
        order by score desc
        ";
        $this->db->selectDatabase();
        return $this->db->query($sql);
    }

    protected function getTopTenPlayers($allPlayers)
    {
        foreach ($allPlayers as $key => $value) {
            if ($value['rank'] > 10) {
                break;
            }
            $this->rankedPlayers[] = $value;
        }
    }

    public function getLevelID($level)
    {
        $levelName = $this::LEVEL;
        $sql = "select levelID
        from $levelName
        where levelName = '$level';";
        $this->db->selectDatabase();
        $result = $this->db->query($sql);
        return $result->fetch()['levelID'];
    }

    protected function getAllPlayers($allPlayers)
    {
        $this->rankedPlayers = $allPlayers;
    }

    protected function getMyRank($allPlayers)
    {
        $players = [];
        foreach ($allPlayers as $key => $value) {
            $players[] = $value;
            if ($value['player'] == SessionManager::get('userName')) {
                $this->rankedPlayers = $players;
            }
        }
    }
}