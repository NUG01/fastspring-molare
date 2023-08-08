<?php

namespace NUG01\Molare\Http\Services;

use NUG01\Molare\Http\Helpers\SubscriptionHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise\Utils;

class FastspringService
{
    public $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getFastspringAccount($request)
    {
        $promise = $this->client->getAsync(
            'https://api.fastspring.com/accounts/' . $request['fastspring_account_id'],
            SubscriptionHelper::fastspringHeaders()
        );
        $response = SubscriptionHelper::promiseHandler($promise);

        return $response;
    }


    public function getFastspringSubscription($request)
    {
        $promise = $this->client->getAsync(
            'https://api.fastspring.com/subscriptions/' . $request['subscription_id'],
            SubscriptionHelper::fastspringHeaders()
        );
        $response = SubscriptionHelper::promiseHandler($promise);

        return $response;
    }


    public function deleteFastspringSubscription($request)
    {
        $promise = $this->client->deleteAsync(
            'https://api.fastspring.com/subscriptions/' . $request['subscription_id'],
            SubscriptionHelper::fastspringHeaders()
        );
        $response = SubscriptionHelper::promiseHandler($promise, 'with-status');

        return $response;
    }


    public function pauseFastspringSubscription($request)
    {
        $promise = $this->client->postAsync(
            'https://api.fastspring.com/subscriptions/' . $request['subscription_id'] . '/pause',
            SubscriptionHelper::fastspringHeaders('post', 'pause', $request->pause_period)
        );
        $response = SubscriptionHelper::promiseHandler($promise, 'with-status');

        return $response;
    }



    public function getFastspringProduct($request)
    {

        $promise = $this->client->getAsync(
            'https://api.fastspring.com/products/' . $request['plan_path'],
            SubscriptionHelper::fastspringHeaders()
        );
        $response = SubscriptionHelper::promiseHandler($promise);

        return $response;
    }
}
