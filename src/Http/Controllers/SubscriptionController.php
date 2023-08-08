<?php

namespace NUG01\Molare\Http\Controllers;

use NUG01\Molare\Http\Repositories\SubscriptionRepository;
use NUG01\Molare\Http\Requests\CancelOrPauseSubscriptionRequest;
use NUG01\Molare\Http\Requests\CreateSubscriptionRequest;
use NUG01\Molare\Models\Subscription;
use App\Traits\Controllers\ControllerMakesActions;
use Illuminate\Http\Request;
use NUG01\Molare\Http\Helpers\SubscriptionHelper;

class SubscriptionController
{
    public static function subscribe($request, $user)
    {
        $subscribe_validation = SubscriptionHelper::subscribeValidation($request);

        $created_subscription = (new SubscriptionRepository())->createSubscription($subscribe_validation, $user);
        return response()->json(['data'=> $created_subscription]);
    }

    public static function cancelSubscription($request, $user)
    {
        $validated_request = SubscriptionHelper::cancelOrPauseValidation($request);
        $response = (new SubscriptionRepository())->cancelSubscription($validated_request, $user);
        return response()->json(['response' => $response]);
    }

    public static function pauseSubscription($request, $user)
    {
        $validated_request = SubscriptionHelper::cancelOrPauseValidation($request);
        $response =  (new SubscriptionRepository())->pauseSubscription($validated_request, $user);
        return response()->json(['response' => $response]);
    }

    public static function continueSubscription($subscriptionId)
    {
        (new SubscriptionRepository())->continueSubscription($subscriptionId);
        return response()->noContent();
    }
}
