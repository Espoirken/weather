<?php

namespace App\Services;

use App\Contracts\ApiServiceInterface;
use GuzzleHttp\Client;

class LocationService implements ApiServiceInterface
{
    private $endpoint = '';
    private $filters = '';

    /**
     * This construct syntax is from PHP 8: Constructor property promotion
     */
    public function __construct(private $key, private $url) {}

    /**
     * Get data from third party API
     *
     * @return object
     */
    public function getData()
    {
        $client = new Client;

        $apiUrl = sprintf("%s/%s?%s", $this->url, $this->endpoint, $this->filters);

        $response = $client->request('GET', $apiUrl);

        return json_decode($response->getBody()->getContents())->features[0] ?? [];
    }

    /**
     * Set filter for API
     *
     * @param array $request
     * @return object
     */
    public function setFilter($request) {
        $filters = http_build_query([
            "text" => $request,
            "type" => "city",
            "filter" => "countrycode:" . config('locations.country'),
            'apiKey' => $this->key
        ]);

        $this->filters = $filters;

        return $this;
    }


    /**
     * Set endpoint for API
     *
     * @param string $endpoint
     * @return Object
     */
    public function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;

        return $this;
    }
}
