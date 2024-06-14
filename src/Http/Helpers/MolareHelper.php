<?php

namespace  NUG01\Molare\Http\Helpers;

use Illuminate\Support\Arr;


class MolareHelper
{
    public static function fastspring_response($response, $data = null)
    {
        return ['result' => Arr::get($response->json(), 'result'), 'data' => $data ? $data : $response->json()];
    }
}
