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

    public function getPlayerSummary()
    {
        $url = $this->baseUrl . 'ISteamUser/GetPlayerSummaries/v0002/?&key=' . env('STEAM_API_KEY') . '&steamids=' . $this->steamId . '&format=json';

        return $url; 
    }

    public function getOwnedGames()
    {
        $url = $this->baseUrl . 'IPlayerService/GetOwnedGames/v00001/?&key=' . env('STEAM_API_KEY') . '&steamid=' . $this->steamId . '&format=json&include_appinfo=true&include_played_free_games=true&include_appinfo=true';

        return $url;
    }

    public function getRecentlyPlayedGames()
    {
        $url = $this->baseUrl . 'IPlayerService/GetRecentlyPlayedGames/v00001/?&key=' . env('STEAM_API_KEY') . '&steamid=' . $this->steamId . '&format=json';

        return $url;
    }

    public function getNumberOfCurrentPlayers($appId)
    {
        $url = $this->baseUrl . 'ISteamUserStats/GetNumberOfCurrentPlayers/v1/?appid=' . $appId;

        return $url;
    }

    public function steamId($steamId)
    {
        $this->steamId = $steamId;

        return $this;
    }

}