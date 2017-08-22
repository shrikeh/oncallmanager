<?php

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use OnCallManager\Repository\OnCall\PagerDuty;
use Psr\Http\Message\ResponseInterface;

require_once __DIR__.'/../vendor/autoload.php';

$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.pagerduty.com'] );

//$credentials = new \OnCallManager\Credentials\PagerDuty('y_NbAkKc66ryYTWUXYEu');
//
//
//$customer = new \OnCallManager\Customer($credentials);
//
//$pagerDuty = new \OnCallManager\Repository\OnCall\PagerDuty($client);

//$pagerDuty->findByCustomer($customer);


$obj = new stdClass();

$requests = function() use ($client, $obj) {

    yield function(array $opts) use ($client, $obj) {
        $uri = new Uri('/oncalls/?time_zone=UTC');

        $request = new Request(
            'GET',
            $uri,
            $opts['headers']
        );

        $obj->promise = $client->sendAsync($request);
        return $obj->promise;
    };

    $users = function() use($obj) {
        $response = $obj->promise->wait();
        $oncalls = json_decode($response->getBody())->oncalls;
        var_dump($oncalls);
        $query = 'include[]=contact_methods';
        foreach ($oncalls as $oncall) {
            $uri = (new Uri($oncall->user->self))->withQuery($query);
            yield new Request('GET', $uri);
        }
    };

    yield from $users();
};

$pool = new \GuzzleHttp\Pool(
    $client,
    $requests(),
    [
        'concurrency' => 20,
        'options' => [
            'headers' => [
                'Accept'        => 'application/vnd.pagerduty+json;version=2',
                'Authorization' => 'Token token=y_NbAkKc66ryYTWUXYEu',
            ],
        ],
        'fulfilled' => function(ResponseInterface $response, $index) {
            if ($index !== 0) {
                foreach (json_decode($response->getBody())->user->contact_methods as $contactMethod) {
                    if ('phone_contact_method' == $contactMethod->type) {
                        var_dump($contactMethod->address);
                    }
                }
            }
        },
        'rejected' => function($response) {

        }
    ]
);

$promise = $pool->promise();
$promise->wait();