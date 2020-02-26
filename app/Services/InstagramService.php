<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use App\Contracts\Provisionable;

class InstagramService implements Provisionable
{
    public function getPosts(array $tags = ['bibmark'], array $options = [])
    {
        $posts = [];
        $limit = 20;
        foreach ($tags as $tag) {
            if ($this->valid(trim($tag))) {
                $bulkPosts = $this->request(trim($tag))['graphql']['hashtag']['edge_hashtag_to_media']['edges'];

                foreach ($bulkPosts as $intaPost) {
                    array_push(
                        $posts, [
                            'id' => $intaPost['node']['id'],
                            'username' => $intaPost['node']['owner']['id'],
                            'date' => $intaPost['node']['taken_at_timestamp'],
                            'url' => $intaPost['node']['display_url'],
                            'description' => isset($intaPost['node']['edge_media_to_caption']['edges'][0]) ?
                                $intaPost['node']['edge_media_to_caption']['edges'][0]['node']['text']: 'https://example.com',
                            'display_url' => $intaPost['node']['display_url']
                        ]
                    );
                }
            }

        }
        $posts = array_slice($posts, 0, $limit);
        return $posts;
    }

    /**
     * Determine if the request is valid.
     *
     * @return bool
     */
    public function valid($tag = 'bibmark', $limit = 20)
    {
        try {
            $this->request($tag, $limit);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Make an HTTP request to Instagram API.
     *
     * @param  string  $tag
     * @return array
     */
    protected function request($tag, $limit = 20)
    {
        if ($tag == '') {
            throw new Exception();
        }

        $response = (new Client)->get('https://www.instagram.com/explore/tags/'.ltrim($tag, '/').'?__a=1');

        return json_decode((string) $response->getBody(), true);
    }
}
