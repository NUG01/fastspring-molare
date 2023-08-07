<?php

namespace NUG01\Molare\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FastspringUser extends Model
{
    protected $guarded = [
      'id',
    ];

    public const TABLE = 'fastspring_users';
    public $table = 'fastspring_users';
    public $timestamps = true;

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
