<?php

namespace App\Actions\Steam;

use App\Services\Steam\SteamWebService;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUserData
{
    use AsAction;

    public function handle($steamId = null)
    {
        $steam = new SteamWebService();
        $url = $steam->steamId($steamId ?? env('STEAM_ID'))->getPlayerSummary();

        $httpClient = new Client();
        $request = $httpClient->get($url);

        $response = json_decode($request->getBody()->getContents());
        if ( empty(data_get($response, 'response.players')) ) {
            return ['username' => 'Not Found'];
        } 

        return ['username' =>  Arr::pluck(data_get($response, 'response.players'), 'personaname')[0]];
    }
}