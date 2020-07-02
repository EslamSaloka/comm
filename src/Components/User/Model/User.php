<?php

namespace App\Components\User\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = "users";

    const Reports = true;

    protected static function boot() {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where([
                ['type','=','client']
            ]);
        });
    }
}
