<?php

namespace App\Http\Livewire\Playground;

use App\Actions\Time\GetDaysFromMinutes;
use App\Services\Steam\SteamWebService;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Livewire\Component;

class Steam extends Component
{
    public $title = "About Me";
    public $totalGames;
    public $totalPlaytime;
    public $steamId;
    public $username;
    public $isExist = true;

    public function render()
    {
        return view('livewire.playground.steam')
            ->layoutData([ 'title' => $this->title]);
    }

    public function mount()
    {
        $this->getData(env('STEAM_ID'));
    }

    public function getData($steamId)
    {
        $this->getUserData($steamId);
        $this->getGameData($steamId);
    }

    public function getGameData($steamId)
    {
        $steam = new SteamWebService();
        $url = $steam->steamId($steamId)->getOwnedGames();

        $httpClient = new Client();
        $request = $httpClient->get($url);
        $response = json_decode($request->getBody()->getContents());

        if (!$this->isExist) {
            $this->totalGames = 'N/A';
            $this->totalPlaytime = 'N/A';
        } else {
            $this->totalGames = data_get($response, 'response.game_count');
            $this->totalPlaytime = $this->calculateTotalPlaytime($response);
        }
    }

    public function getUserData($steamId)
    {
        $steam = new SteamWebService();
        $url = $steam->steamId($steamId)->getPlayerSummary();

        $httpClient = new Client();
        $request = $httpClient->get($url);

        $response = json_decode($request->getBody()->getContents());
        if ( empty(data_get($response, 'response.players')) ) {
            $this->username = 'Not Found';
            $this->isExist = false;
        } else {
            $this->username = Arr::pluck(data_get($response, 'response.players'), 'personaname')[0];
        }
    }

    /**
     * The total playtime is returned in minutes
     *
     * @param [type] $response
     * @return integer
     */
    public function calculateTotalPlaytime($response) 
    {
        $playtime = Arr::pluck(data_get($response, 'response.games'), 'playtime_forever');

        return GetDaysFromMinutes::run(collect($playtime)->sum());
    }

    public function retrieve()
    {
        $this->getData($this->steamId);
    }

    
    public function resetData()
    {
        $this->getData(env('STEAM_ID'));
    }
}
