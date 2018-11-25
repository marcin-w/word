<?php

namespace App\Service;

class ApiClient
{
    public function getResponse(string $word, string $language)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request(
            'GET',
            'https://od-api.oxforddictionaries.com/api/v1/entries/' . $language . '/' . $word,
            [
                'headers' => ['app_id' => '57cba1ff', 'app_key' => '97af654a6758b5a512f49aefb64696d0']
            ]
        );

        return $res->getBody();
        //to daje obiekt, a chcemy stringa? nowa klasa ? :(
        $data = json_decode($res->getBody());

        return $data;
    }
}