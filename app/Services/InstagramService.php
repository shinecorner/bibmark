<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Contracts\Provisionable;

class InstagramService implements Provisionable
{
    public function __construct()
    {
    }

    public function getPosts(string $tag = 'bibmark', array $options = [])
    {
        $data = $this->request($tag);
        // https://stackoverflow.com/a/48682863/5442966
        $content = $data['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
        $posts = [];

        foreach ($content as $data) {
            array_push(
                $posts, [
                    'id' => $data['node']['id'],
                    'username' => 'John Doe',
                    'date' => $data['node']['taken_at_timestamp'],
                    'description' => $data['node']['edge_media_to_caption']['edges'][0]['node']['text'],
                    'image_url' => $data['node']['display_url']
                ]
            );
        }

        return $posts;
    }

    /**
     * Make an HTTP request to Instagram API.
     *
     * @param  string  $tag
     * @return array
     */
    protected function request($tag)
    {
        $response = (new Client)->get('https://www.instagram.com/explore/tags/'.ltrim($tag, '/').'?__a=1');

        return json_decode((string) $response->getBody(), true);
    }
}