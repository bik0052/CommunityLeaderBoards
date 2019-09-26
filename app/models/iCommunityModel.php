<?php


interface iCommunityModel
{
    public function getPlayers($level, $whichPlayers);

    public function getLevelID($level);
}