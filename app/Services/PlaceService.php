<?php

namespace App\Services;

use App\Contracts\ApiServiceInterface;
use GuzzleHttp\Client;

class PlaceService implements ApiServiceInterface
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

        $response = $client->request('GET', $apiUrl, [
            'headers' => [
              'Accept' => 'application/json',
              'Authorization' => $this->key,
            ],
        ]);

        return json_decode($response->getBody()->getContents())->results ?? [];
    }

    /**
     * Set filter for API
     *
     * @param array $request
     * @return object
     */
    public function setFilter($request) {
        $filters = http_build_query([
            "near" => $request['search']. "," . config('locations.country')
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
