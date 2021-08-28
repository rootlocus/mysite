<?php

namespace App\Actions\Steam;

use App\Http\Resources\TopGameResource;
use App\Services\Steam\SteamWebService;
use Exception;
use Illuminate\Support\Arr;
use GuzzleHttp\Client;
use Lorisleiva\Actions\Concerns\AsAction;

class GetGameData
{
    use AsAction;

    public function handle($steamId = null)
    {
        $steam = new SteamWebService();
        $url = $steam->steamId($steamId ?? env('STEAM_ID'))->getOwnedGames();

        try {
            $httpClient = new Client();
            $request = $httpClient->get($url);
            $response = json_decode($request->getBody()->getContents());
            $topGames = collect(data_get($response, 'response.games'))
                ->sortByDesc('playtime_forever')
                ->take(10);
        } catch (Exception $e) {
            info($e);

            return [
                'totalGames' => 0,
                'totalPlaytime' => 0,
                'topGames' => [
                    'data' => [],
                    'meta' => [
                        'games' => [],
                        'values' => []
                    ]
                ]
                // TopGameResource::collection($topGames)->additional(['meta' => [
                //     'games' => $topGames->pluck('name'),
                //     'values' => $topGames->pluck('playtime_forever'),
                // ]]),
            ];
        }

        return [
            'totalGames' => data_get($response, 'response.game_count'),
            'totalPlaytime' => $this->calculateTotalPlaytime($response),
            'topGames' => TopGameResource::collection($topGames)->additional(['meta' => [
                'games' => $topGames->pluck('name'),
                'values' => $topGames->pluck('playtime_forever'),
            ]]),
        ];
    }

    public function calculateTotalPlaytime($response) 
    {
        $playtime = Arr::pluck(data_get($response, 'response.games'), 'playtime_forever');

        $playtime = (int) collect($playtime)->sum() * 60;

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$playtime");

        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
    }
}