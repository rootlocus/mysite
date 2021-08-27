<?php

namespace App\Http\Livewire\Playground;

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
        $steam = new SteamWebService();
        $url = $steam->steamId($steamId)->getOwnedGames();

        $httpClient = new Client();
        $request = $httpClient->get($url);

        $response = json_decode($request->getBody()->getContents());

        $this->totalGames = data_get($response, 'response.game_count');
        $this->totalPlaytime = $this->calculateTotalPlaytime($response);
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

        $playtime = (int) collect($playtime)->sum() * 60;

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$playtime");

        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
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
