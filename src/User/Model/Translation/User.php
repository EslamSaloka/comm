<?php

namespace App\Components\User\Model\Translation;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = "user_translations";
    protected $fillable = [];
    protected $guarded = ['user_id'];
    public $timestamps = false;

}
