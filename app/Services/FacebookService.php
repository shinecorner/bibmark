<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Contracts\Provisionable;

class FacebookService implements Provisionable
{

    public function getPosts(array $tags = ['bibmark'], array $options = [])
    {
        return [];
    }

    /**
     * Make an HTTP request to Facebook API.
     *
     * @param  string  $tag
     * @return mixed
     */
    protected function request($tag, $limit=10)
    {
        $response = (new Client)->get('https://www.instagram.com/explore/tags/'.ltrim($tag, '/').'?__a=1');

        return json_decode((string) $response->getBody(), true);
    }
}