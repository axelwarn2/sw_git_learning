<?php

class ApiService
{
    public function fetchData($url, $apikey)
    {
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    "x-api-key: {$apikey}",
                    "Accept: application/json",
                ],
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return json_decode($result, true);
    }
}
