<?php

namespace NUG01\Molare\Models;

use App\Models\User;
use NUG01\Molare\Models\FastspringUser;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [
      'id',
    ];

    public const TABLE = 'subscriptions';
    public $table = 'subscriptions';
    public $timestamps = true;


    protected $casts = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fastspringUser()
    {
        return $this->belongsTo(FastspringUser::class, 'fastspring_account_id', 'account_id');
    }
}
