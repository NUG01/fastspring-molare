<?php

namespace  NUG01\Molare\Http\Helpers;

use App\Models\Subscription\FastspringUser;
use NUG01\Molare\Models\Subscription;
use GuzzleHttp\Promise;

class SubscriptionHelper
{
    public static function isSubscribed()
    {
        return self::subscriptionCheckQuery('check');
    }

    public static function subscriptionExpired()
    {
        return !self::subscriptionCheckQuery('check');
    }

    public static function userSubscription()
    {
        return self::subscriptionCheckQuery('get');
    }

    private static function subscriptionCheckQuery($action = 'get')
    {
        $query = Subscription::where('user_id', auth()->user()->id)->where('ends_at', '>=', now())->where('active', true);
        if ($action == 'get') {
            return $query->first();
        }
        if ($action == 'check') {
            return $query->exists();
        }
    }

    public static function fastspringHeaders($action = null, $method = null, $pausePeriod = null)
    {
        return  [
          'body' => $method == 'pause' ? '[{"pausePeriodCount":' . $pausePeriod . '}]' : '',
          'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Basic ' . env('FASTSPRING_TOKEN'),
            $action == 'post' ? "'content-type' => 'application/json'" : '',
          ]
        ];
    }

    public static function decodeContent($req)
    {
        return json_decode($req->getBody()->getContents());
    }


    public static function decodeStatus($req)
    {
        return $req->getStatusCode();
    }


    public static function promiseHandler($promise, $status = null)
    {
        return $promise->then(
            function ($response) use ($status) {
                if ($status == 'with-status') {
                    return [
                      'status' => self::decodeStatus($response),
                      'data' => self::decodeContent($response)
                    ];
                }
                return self::decodeContent($response);
            }
        )->wait();
    }
}
