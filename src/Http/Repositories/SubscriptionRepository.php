<?php

namespace NUG01\Molare\Http\Repositories;

use NUG01\Molare\Http\Helpers\SubscriptionHelper;
use NUG01\Molare\Http\Services\FastspringService;
use NUG01\Molare\Models\FastspringUser;
use NUG01\Molare\Models\Subscription;

class SubscriptionRepository
{
    private $fastspring_service;

    public function __construct()
    {
        $this->fastspring_service = new FastspringService();
    }

    public function createSubscription($request, $user)
    {
        try {
            $this->createFastspringUser($request);

            $subscription = Subscription::where('user_id', auth()->user()->id)->where('active', true)->get();
            if ($subscription->count() > 0) {
                for ($i = 0; $i < $subscription->count(); $i++) {
                    $subscription[$i]->update(['active' => 0, 'cancelled_at' => now()]);
                    $this->cancelSubscription($subscription[$i], $user);
                }
            }
            $sub=$this->fastspring_service->getFastspringSubscription($request);

            $subscription =   Subscription::create([
              'user_id' => $user->id,
              'fastspring_account_id' => $request->fastspring_account_id,
              'subscription_id' => $request->subscription_id,
              'order_reference' => $sub->initialOrderReference,
              'fastspring_id' => $request->fastspring_id,
              'plan' => strtolower($sub->product),
              'currency' => $sub->currency,
              'interval_type' => $sub->subscriptions->intervalUnit,
            ]);

            $user->update(['plan'=>strtolower($request->plan)]);


            return $subscription;
        } catch (\Exception $e) {
            throw new $e('Subscription failed!');
        }
    }



    private function createFastspringUser($request, $dataToReturn = 'created-user')
    {

        if ($fastspring_user = FastspringUser::where('account_id', $request->fastspring_account_id)->first()) {
            return $fastspring_user;
        }


        try {
            $content = $this->fastspring_service->getFastspringAccount($request);

            $fastspring_user = FastspringUser::create([
              'account_id' => $content->account,
              'user_id' => auth()->user()->id,
              'fullname' => $content->contact->first . ' ' . $content->contact->last,
              'phone_number' => $content->contact->phone,
              'email' => $content->contact->email,
              'country' => $content->country,
              'lang' => $content->language,
              'address' => $content->address->addressLine1,
            ]);

            return $fastspring_user;

        } catch (\Exception $e) {
            throw new $e('Something went wrong!');
        }
    }


    public function cancelSubscription($request, $user)
    {

        $response = $this->fastspring_service->deleteFastspringSubscription($request);
        if ($response['status'] == 200) {
            $subscription = Subscription::where('subscription_id', $request->subscription_id)->first();
            $subscription->update(['active' => false, 'cancelled_at' => now()]);
            $user->update(['plan'=>strtolower($request->plan)]);

        }
        return $response['data'];
    }


    public function pauseSubscription($request, $user)
    {

        try {
            $response = $this->fastspring_service->pauseFastspringSubscription($request);

            if ($response['status'] == 200) {
                $subscription = Subscription::where('subscription_id', $request->subscription_id)->first();
                $subscription->update(['active' => false, 'paused_at' => now()]);
                $user->update(['plan'=>'free']);
                return $response['data'];
            }
        } catch (\Exception $e) {
            throw new $e('Something went wrong!');
        }
    }
}
