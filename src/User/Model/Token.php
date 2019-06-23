<?php

namespace App\Components\User\Model;

use Illuminate\Database\Eloquent\Model;

class Token extends Model {

    protected $table = "tokens";
    protected $fillable = [
        'user_id',
        'device_type',
        'device_token',
    ];

}
