<?php

namespace App\Services;

use Exception;

class HttpClient {

    public function getJsonBodyResponse($url)
    {
        try {
            $request = $this->httpClient->get($url);
            
            return json_decode($request->getBody()->getContents());
        } catch (Exception $exception) {
            abort(500, $exception->getMessage());
        }
    } 
}