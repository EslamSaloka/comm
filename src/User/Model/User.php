<?php

namespace App\Components\User\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    use \Dimsav\Translatable\Translatable;

    protected $translationForeignKey = "user_id";
    public $translatedAttributes = [];
    public $translationModel = 'App\Components\User\Model\Translation\User';
    protected $table = "user";
    protected $fillable = [];

}
