<?php

namespace App\Components\Admins\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Admin extends Model {

    protected $table = "users";

    const Reports = true;

    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'type',
        'api_token',
        'extra_data',
        'country_id',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];


    protected static function boot() {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where([
                ['type','=','admin']
            ]);
        });
    }

    public static function createdAdmin($request) {
        $request['type']         = 'admin';
        $request['password']     = \Hash::make(request('password'));
        $request['phone']        = '000000000';
        $request['api_token']    = User::generator_api_token();
        $request['actived']      = 1;
        $request['country_id']   = '0';
        $request['actived_code'] = 0000;
        $request['extra_data']   = [];
        // dd($request);
        Admin::create($request);
    }

    public static function updatedAdmin($admin,$request) {
        if(array_key_exists('password',$request)) {
            if(!is_null($request['password'])) {
                $request['password']  = \Hash::make(request('password'));
            } else {
                unset($request['password']);
            }
        }
        if(array_key_exists('phone',$request)) {
            $request['phone']    = sanitize_mobile($request['phone']);
        }
        $admin->update($request);
    }

}
