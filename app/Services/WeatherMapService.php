<?php

namespace App\Services;

use App\Traits\Log;
use ErrorException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class WeatherMapService
{
    use Log;

    /**
     * @var Client HTTP Client
     */
    protected $client;

    /**
     * @var string  weather Api key
     */
    protected $appId;

    /**
     * @var string URL base
     */
    protected $url = 'http://api.openweathermap.org/data/2.5/weather';

    /**
     * @var array URL Parameters
     */
    protected $urlParams = [
        'lang' => 'ru',
        'units' => 'metric'
    ];

    /**
     * @param string $source
     * @param string $target
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->setAppId(config('weathermap.weather-key'));
    }


    public function prepareParams(string $city)
    {
        $this->urlParams = array_merge($this->urlParams, [
            'appid' => $this->appId,
            'q'     => $city
        ]);
    }


    /**
     * @param string $id
     * @return $this
     */
    public function setAppId(string $id): self
    {
        $this->appId = $id;

        return $this;
    }


    /**
     * @param string $city String to city
     * @return array
     * @throws ErrorException|GuzzleException
     */
    public function getWeather(string $city)
    {
        $this->prepareParams($city);
        $response = $this->getData();

        return  $this->addLog($response) ? $response : [];
    }

    /**
     * Get response array.
     * @return array
     * @throws ErrorException|GuzzleException
     * @throws RequestException
     */
    public function getData(): array
    {
        try {
            $response = $this->client->get($this->url, [
                    'query' => http_build_query($this->urlParams)
                ]
            );

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [];
        }
    }

}
