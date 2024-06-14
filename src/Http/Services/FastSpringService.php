<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use NUG01\Molare\Http\Helpers\MolareHelper;
use Illuminate\Http\Request;


class FastSpringService
{
    public $client;
    public $baseUrl;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.fastspring.com/')
            ->withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])
            ->withBasicAuth(config('fastspring.credentials.username'), config('fastspring.credentials.password'));
    }

    public function getAccount($account_id)
    {
        $response = $this->client->get("accounts/$account_id", []);

        return MolareHelper::fastspring_response($response);
    }

    public function getManagementUrl($account_id)
    {
        $response = $this->client->get("accounts/$account_id/authenticate");

        return MolareHelper::fastspring_response($response, Arr::get($response->json()['accounts'][0], 'url'));
    }

    public function getSubscription($subscription_id)
    {
        $response = $this->client->get("subscriptions/$subscription_id");

        return MolareHelper::fastspring_response($response);
    }

    public function updateAccount(string $account_id, $request)
    {
        $validated = $request->validate([
            'first' => 'required|string',
            'last' => 'required|string',
            'email' => 'required|email',
            'company' => 'required|string',
            'phone' => 'required|string',
        ]);

        $payload = [
            'contact' => [],
        ];

        foreach ($validated as $key => $value) {
            $payload['contact'][$key] = $value ?? '';
        }

        $response = $this->client->post("accounts/$account_id", $payload);

        return MolareHelper::fastspring_response($response);
    }

    public function pauseSubscription(string $subscription_id, $period_count = 1)
    {
        $response = $this->client->post("subscriptions/$subscription_id/pause", [
            'pausePeriodCount' => $period_count,
        ]);

        return MolareHelper::fastspring_response($response);
    }

    public function resumeSubscription(string $subscription_id)
    {
        $response = $this->client->post("subscriptions/$subscription_id/resume", []);

        return MolareHelper::fastspring_response($response);
    }
}
