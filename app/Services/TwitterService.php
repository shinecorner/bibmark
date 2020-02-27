<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\Contracts\Provisionable;

class TwitterService implements Provisionable
{

    public function getPosts(array $tags = ['bibmark'], array $options = [])
    {
        $tweets = [];
        $limit = 10;

        foreach ($tags as $tag) {                        
            try{
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
                            'profile_image_url' => $tweet['user']['profile_image_url_https'],
                            'profile_banner_url' => isset($tweet['user']['profile_banner_url']) ? $tweet['user']['profile_banner_url'] : "",
                            'profile_statuses_count' => isset($tweet['user']['statuses_count']) ? $tweet['user']['statuses_count'] : 0,
                        ]
                    );
                }
            }
            catch (Exception $e) {
                return [];
            }            
        }
        $tweets = array_slice($tweets, 0, $limit);
        return $tweets;
    }

    /**
     * Determine if the request is valid.
     *
     * @return bool
     */
    public function valid($tag = 'bibmark', $limit = 100)
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
    protected function request($tag = 'bibmark', $limit = 100)
    {

        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'  => config('social.twitter.consumer_key'),
            'consumer_secret' => config('social.twitter.consumer_secret'),
            'token'       => config('social.twitter.token'),
            'token_secret'  => config('social.twitter.token_secret')
        ]);
        $stack->push($middleware);

        $client = new Client([
            'base_uri' => 'https://api.twitter.com/1.1/',
            'handler' => $stack
        ]);
        
        $response = $client->request('GET', 'search/tweets.json', [
            'auth' => 'oauth',
            'query' => ['q' => $tag, 'count' => $limit]
        ]);        
        return json_decode((string) $response->getBody(), true);
    }
}