# NUG01 Molare - FastSpring Subscriptions Integration for Laravel

**NUG01 Molare** is a Laravel package that simplifies the integration of FastSpring subscriptions into your Laravel application. It provides a convenient set of controllers and helper functions to manage subscriptions.

#
### Installation

You can install the package via Composer by running the following command:

```sh
composer require nug01/molare:dev-master
```


#
### Environment

Add the fastspring secret key in .env like this:

```sh
FASTSPRING_TOKEN={YOUR_FASTSPRING_SECRET_KEY}
```


#
### Publishing

Next, publish the package's configuration file, If you want:
```sh
php artisan vendor:publish --provider="NUG01\Molare\MolareServiceProvider" --tag="config"molare:dev-master
```


#
### Usage

Subscription: Subscribe a user.

```sh
use NUG01\Molare\Http\Controllers\SubscriptionController as Molare;

// ...

public function subscribe(Request $request)
{
    $res = Molare::subscribe($request, auth()->user());
    return response()->json(['data' => $res]);
}
```


Cancel Subscription: Cancel a user's subscription.

```sh
public function cancelSubscription(Request $request)
{
    $res = Molare::cancelSubscription($request, auth()->user());
    return response()->json(['data' => $res]);
}
```

Pause Subscription: Pause a user's subscription.

```sh
public function pauseSubscription(Request $request)
{
    $res = Molare::pauseSubscription($request, auth()->user());
    return response()->json(['data' => $res]);
}
```

Continue Subscription: Continue a paused subscription.

```sh
public function continueSubscription(Request $request)
{
    Molare::continueSubscription($request);
    return response()->noContent();
}
```


#
### Helper Functions

Subscription: Subscribe a user.

```sh
use NUG01\Molare\Http\Helpers\SubscriptionHelper;

// ...

// Check subscription status
if (SubscriptionHelper::isSubscribed()) {
    // Handle subscribed user
}

// Check subscription expiration status
if (SubscriptionHelper::subscriptionExpired()) {
    // Handle expired subscription
}

// Get the subscription details
$subscription = SubscriptionHelper::userSubscription();
```


#
### Configuration

You can configure the package by modifying the config/molare.php file. This file allows you to set various options related to the FastSpring integration and subscription management.
Support

### Support

If you encounter any issues or need assistance, please open an issue on GitHub.
License

### License

This package is open-source software licensed under the MIT license.




