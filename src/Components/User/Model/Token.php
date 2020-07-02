<?php

namespace App\Components\User\Model;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $table = "tokens";

    protected $fillable = [
        'user_id',
        'type',
        'token',
    ];
    public $timestamps = false;
}
