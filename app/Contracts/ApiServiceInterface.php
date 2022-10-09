<?php

namespace App\Contracts;

interface ApiServiceInterface
{
    /**
     * ApiServiceInterface constructor.
     */
    public function __construct($key, $url);

    /**
     * Set the query filter for API
     */
    public function setFilter($request);

    /**
     * Set the API endpoint
     */
    public function setEndpoint($endpoint);

    /**
     * Get the data from the API
     */
    public function getData();
}
