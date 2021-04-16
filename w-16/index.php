<?php

class Api
{
    public function api()
    {
        $queryString = http_build_query([
'access_key' => 'c94c9fb5f1db6b8619bdd90a209beafa',
]);

        $ch = curl_init(sprintf('%s?%s', 'https://api.aviationstack.com/v1/flights', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $api_result = json_decode($json, true);

        foreach ($api_result['results'] as $flight) {
            if (!$flight['live']['is_ground']) {
                echo sprintf('%s flight %s from %s (%s) to %s (%s) is in the air.',
$flight['airline']['name'],
$flight['flight']['iata'],
$flight['departure']['airport'],
$flight['departure']['iata'],
$flight['arrival']['airport'],
$flight['arrival']['iata']
), PHP_EOL;
            }
        }
    }
}

$a = new Api();
$a->api();
