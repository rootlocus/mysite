<?php

namespace App\Services\Steam;

class SteamWebService
{
    private $baseUrl = 'http://api.steampowered.com/';
    private $steamId = 'xxxxxxxxxxxxxxxxx';
    // private $interface = '';
    // private $method;
    // private $version;
    // private $key;
    // private $format;

    public function getOwnedGames()
    {
        $url = $this->baseUrl . 'IPlayerService/GetOwnedGames/v00001/?&key=' . env('STEAM_API_KEY') . '&steamid=' . $this->steamId . '&format=json&include_appinfo=true&include_played_free_games=true';

        return $url;
    }

    public function getPlayerSummary()
    {
        $url = $this->baseUrl . 'ISteamUser/GetPlayerSummarie/v00002/?&key=' . env('STEAM_API_KEY') . '&steamid=' . $this->steamId . '&format=json';

        return $url;
    }
    
    public function steamId($steamId)
    {
        $this->steamId = $steamId;

        return $this;
    }

}