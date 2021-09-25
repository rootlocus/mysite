<?php

namespace App\Services\Steam;

use App\Services\HttpClient;
use Exception;
use GuzzleHttp\Client;

class SteamWebService extends HttpClient
{
    protected $baseUrl = 'http://api.steampowered.com/';
    protected $steamId = 'xxxxxxxxxxxxxxxxx';
    protected $httpClient;
    // private $interface = '';
    // private $method;
    // private $version;
    // private $key;
    // private $format;

    public function __construct($steamId)
    {
        $this->steamId = $steamId ?? env('STEAM_ID');
        $this->httpClient = new Client();

    }

    public function getPlayerSummary()
    {
        $url = $this->baseUrl . 'ISteamUser/GetPlayerSummaries/v0002/?&key=' . env('STEAM_API_KEY') . '&steamids=' . $this->steamId . '&format=json';

        return $this->getJsonBodyResponse($url);
    }

    public function getOwnedGames()
    {
        $url = $this->baseUrl . 'IPlayerService/GetOwnedGames/v00001/?&key=' . env('STEAM_API_KEY') . '&steamid=' . $this->steamId . '&format=json&include_appinfo=true&include_played_free_games=true&include_appinfo=true';

        return $this->getJsonBodyResponse($url);
    }

    public function getRecentlyPlayedGames()
    {
        $url = $this->baseUrl . 'IPlayerService/GetRecentlyPlayedGames/v00001/?&key=' . env('STEAM_API_KEY') . '&steamid=' . $this->steamId . '&format=json';

        return $this->getJsonBodyResponse($url);
    }

    public function getNumberOfCurrentPlayers($appId)
    {
        $url = $this->baseUrl . 'ISteamUserStats/GetNumberOfCurrentPlayers/v1/?appid=' . $appId;

        return $this->getJsonBodyResponse($url);
    }

}