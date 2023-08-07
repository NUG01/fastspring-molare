<?php

namespace NUG01\Molare\Http\Controllers;

use NUG01\Molare\Http\Repositories\SubscriptionRepository;
use NUG01\Molare\Http\Requests\CancelOrPauseSubscriptionRequest;
use NUG01\Molare\Http\Requests\CreateSubscriptionRequest;
use NUG01\Molare\Models\Subscription;
use App\Traits\Controllers\ControllerMakesActions;
use Illuminate\Http\Request;

class SubscriptionController
{
    public static function subscribe(CreateSubscriptionRequest $request)
    {
        $created_subscription = (new SubscriptionRepository())->createSubscription($request, auth()->user());
        return response()->json(['data' => $created_subscription]);
    }

    public static function cancelSubscription(CancelOrPauseSubscriptionRequest $request)
    {
        $response = (new SubscriptionRepository())->cancelSubscription($request, auth()->user());
        return response()->json(['response' => $response]);
    }

    public static function pauseSubscription(CancelOrPauseSubscriptionRequest $request)
    {
        $response =  (new SubscriptionRepository())->pauseSubscription($request, auth()->user());
        return response()->json(['response' => $response]);
    }

    public static function manageSubscriptions(Request $request)
    {
        Subscription::where('subscription_id', $request->subscription_id)
          ->update(['active' => true, 'cancelled_at' => null, 'ends_at' => now()->addDays(30)]);
        return response()->noContent();
    }
}
