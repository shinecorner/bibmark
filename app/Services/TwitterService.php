<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use App\Contracts\Provisionable;

class TwitterService implements Provisionable
{

    public function getPosts(array $tags = ['bibmark'], array $options = [])
    {
        $tweets = [];

        foreach ($tags as $tag) {
            
            if ($this->valid(trim($tag))) {

                $bulkTweets = $this->request(trim($tag))['statuses'];

                foreach ($bulkTweets as $tweet) {
                    array_push(
                        $tweets, [
                            'id' => $tweet['id'],
                            'username' => $tweet['user']['name'],
                            'screen_name' => $tweet['user']['screen_name'],
                            'date' => $tweet['created_at'],
                            'description' => $tweet['text'],
                            'url' => isset($tweet['entities']['urls'][0])?
                                $tweet['entities']['urls'][0]['url'] : 'https://example.com',
                            'retweet_count' => $tweet['retweet_count'],
                            'favorite_count' => $tweet['favorite_count'],
                            'profile_image_url' =>$tweet['user']['profile_image_url']
                        ]
                    );
                }
            }

        }

        return $tweets;
    }

    /**
     * Determine if the request is valid.
     *
     * @return bool
     */
    public function valid($tag = 'bibmark', $limit = 10)
    {
        try {
            $this->request($tag, $limit);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Make an HTTP request to Facebook API.
     *
     * @param  string  $tag
     * @return mixed
     */
    protected function request($tag = 'bibmark', $limit = 10)
    {
        $response = (new Client)->get('https://api.twitter.com/1.1/search/tweets.json?q='.$tag.'&count=' . $limit, [
            'headers' => [
                'Authorization' => 'Bearer '. config('social.twitter.oauth2')
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}