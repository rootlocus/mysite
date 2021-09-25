<?php

namespace App\Actions\Steam;

use App\Http\Resources\TopGameResource;
use App\Services\Steam\SteamWebService;
use Exception;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class GetGameData
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
        try {
            $response = $this->service->getOwnedGames();

            $topGames = collect(data_get($response, 'response.games'))
                ->sortByDesc('playtime_forever')
                ->take(10);
        } catch (Exception $e) {
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

    //todo put into global helper
    public function calculateTotalPlaytime($response) 
    {
        $playtime = Arr::pluck(data_get($response, 'response.games'), 'playtime_forever');

        $playtime = (int) collect($playtime)->sum() * 60;

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$playtime");

        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
    }
}