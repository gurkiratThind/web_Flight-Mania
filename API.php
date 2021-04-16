<?php

class API
{
    public function AccessAPI($url, $method, $queryString)
    {
        $ch = curl_init(sprintf('%s?%s', $url.$method, $queryString));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $flight = json_decode($data, true);
        curl_close($ch);

        return $flight;
    }
}
