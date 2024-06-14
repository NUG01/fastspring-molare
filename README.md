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


# Usage

### Setup

Add the following credentials to your `.env` file:

```dotenv
FASTSPRING_USERNAME=your_fastspring_username
FASTSPRING_PASSWORD=your_fastspring_password
```

```
Account: Get an account.

```sh
use App\Services\FastSpringService;
// ...

$service = new FastSpringService();
$response = $service->getAccount($account_id);
return response()->json(['data' => $response['data'], 'result' => $response['result']]);

```

Management URL: Get the management URL for an account.

```
use App\Services\FastSpringService;

// ...

$service = new FastSpringService();
$response = $service->getManagementUrl($account_id);
return response()->json(['data' => $response['data'], 'result' => $response['result']]);
```

Subscription: Get subscription details.

```
use App\Services\FastSpringService;

// ...

$service = new FastSpringService();
$response = $service->getSubscription($subscription_id);
return response()->json(['data' => $response['data'], 'result' => $response['result']]);
```

Update Account: Update account details.

```
use App\Services\FastSpringService;
use Illuminate\Http\Request;

// ...

$service = new FastSpringService();
$response = $service->updateAccount($account_id, $request);
return response()->json(['data' => $response['data'], 'result' => $response['result']]);
```

Pause Subscription: Pause a subscription.

```
use App\Services\FastSpringService;

// ...

$service = new FastSpringService();
$response = $service->pauseSubscription($subscription_id, 1); // Adjust period count as needed
return response()->json(['data' => $response['data'], 'result' => $response['result']]);
```

Resume Subscription: Resume a paused subscription.

```
use App\Services\FastSpringService;

// ...

$service = new FastSpringService();
$response = $service->resumeSubscription($subscription_id);
return response()->json(['data' => $response['data'], 'result' => $response['result']]);
```

#
### Configuration

You can configure the package by modifying the config/fastspring.php file. This file allows you to set various options related to the FastSpring integration and subscription management.
Support

### Support

If you encounter any issues or need assistance, please open an issue on GitHub.
License

### License

This package is open-source software licensed under the MIT license.




