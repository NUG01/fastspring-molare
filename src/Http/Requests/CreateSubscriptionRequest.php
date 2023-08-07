<?php

namespace NUG01\Molare\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'fastspring_account_id' => ['required'],
          'subscription_id' => ['required'],
          'fastspring_id' => ['required', 'string'],
        ];
    }
}
