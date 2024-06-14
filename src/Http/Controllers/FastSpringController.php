<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FastSpringService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FastSpringController extends Controller
{
  public $fs_service;

  public function __construct()
  {
    $this->fs_service = new FastSpringService();
  }


  public function accountCreatedWebhook(Request $request)
  {
    $payload = $request->all();

    $eventData = Arr::get($payload, 'events.0.data');

    $email = Arr::get($eventData, 'contact.email');

    User::where('email', $email)->update([
      'fs_account_id' => $eventData['account'],
    ]);
  }
}
