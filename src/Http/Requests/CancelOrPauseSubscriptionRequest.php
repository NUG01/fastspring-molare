<?php

namespace NUG01\Molare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelOrPauseSubscriptionRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'subscription_id' => ['required'],
      'pause_period' => ['sometimes'],
    ];
  }
}
