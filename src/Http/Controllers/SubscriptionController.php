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
    private $subscription_repository;

    public function __construct()
    {
        $this->subscription_repository = new SubscriptionRepository();
    }

    public function subscribe(CreateSubscriptionRequest $request)
    {
        $created_subscription = $this->subscription_repository->createSubscription($request, auth()->user());
        return response()->json(['data' => $created_subscription]);
    }

    public function cancelSubscription(CancelOrPauseSubscriptionRequest $request)
    {
        $response = $this->subscription_repository->cancelSubscription($request, auth()->user());
        return response()->json(['response' => $response]);
    }

    public function pauseSubscription(CancelOrPauseSubscriptionRequest $request)
    {
        $response =  $this->subscription_repository->pauseSubscription($request, auth()->user());
        return response()->json(['response' => $response]);
    }

    public function manageSubscriptions(Request $request)
    {
        Subscription::where('subscription_id', $request->subscription_id)
          ->update(['active' => true, 'cancelled_at' => null, 'ends_at' => now()->addDays(30)]);
        return response()->noContent();
    }
}
