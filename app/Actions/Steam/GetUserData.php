<?php

namespace App\Actions\Steam;

use App\Services\Steam\SteamWebService;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUserData
{
    use AsAction;

    protected $steamId;
    protected $service;
    
    public function __construct($steamId = null)
    {
        $this->steamId = $steamId ?? env('STEAM_ID');
        $this->service = new SteamWebService($this->steamId);
    }

    public function handle()
    {
        $response = $this->service->getPlayerSummary();
        
        if ( empty(data_get($response, 'response.players')) ) {
            return null;
        }

        return ['username' =>  Arr::pluck(data_get($response, 'response.players'), 'personaname')[0]];
    }
}