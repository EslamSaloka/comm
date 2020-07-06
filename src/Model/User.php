<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    const Reports = true;

    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'extra_data',
        'type',
        'actived',
        'actived_code',
        'api_token',
        'image',
        'country_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];

    public static function createForm($request)
    {
        $request['password'] = bcrypt($request['password']);
        if (request()->has('image')) {
            $request['image'] = file_upload(request('image'), 'users');
        }
        $request['type']      = 'user';

        $phone   = sanitize_mobile_my_country($request['phone'],$request['country_id']);
        if($phone['status'] == 0) {
            return ['status'=>0,'error'=>$phone['message']];
        }
        if(self::checkPhone($phone['phone']) != '0') {
            return ['status'=>0,'error'=>__('This Phone Used Before')];
        }
        if(self::checkPhone($request['email']) != '0') {
            return ['status'=>0,'error'=>__('This Email Used Before')];
        }
        $request['phone'] = $phone['phone'];

        $request['api_token'] = self::generator_api_token();
        self::create($request);
        return ['status'=>1];
    }

    public static function checkPhone($phone) {
        $user = User::where(['phone'=>$phone])->first();
        if(is_null($user)) {
            return '0';
        }
        return $user;
    }

    public static function checkEmail($email) {
        $user = User::where(['email'=>$email])->first();
        if(is_null($user)) {
            return '0';
        }
        return $user;
    }

    public static function UpdateForm($request, $user)
    {
        if (request()->has('password') && !is_null(request('password'))) {
            $request['password'] = bcrypt($request['password']);
        } else {
            unset($request['password']);
        }
        if (request()->has('image')) {
            $request['image'] = file_upload(request('image'), 'users');
        }
        
        $phone   = sanitize_mobile_my_country($request['phone'],$request['country_id']);
        if($phone['status'] == 0) {
            return ['status'=>0,'error'=>$phone['message']];
        }
        $checkPhone = self::checkPhone($phone['phone']);
        if($checkPhone == '0') {
            $request['phone'] = $phone['phone'];
            $user->update($request);
            return ['status'=>1];
        } 
        if($checkPhone->id == $user->id) {
            $request['phone'] = $phone['phone'];
            $user->update($request);    
            return ['status'=>1];
        } else {
            return ['status'=>0,'error'=>__('This Phone Used Before')];
        }
    }


    public static function generator_api_token()
    {
        $random = Str::random(60);
        $check = self::where(['api_token' => $random])->first();
        if (!is_null($check)) {
            self::generator_api_token();
        }
        return $random;
    }

    public function getDisplayImageAttribute()
    {
        return url($this->image ?? '/uploads/logo.png');
    }

    public function getDisplayPhoneAttribute()
    {
        return str_replace($this->country->country_code,'',$this->phone);
    }

    public function country() {
        return $this->hasOne(\App\Components\Country\Model\Country::class, 'id', 'country_id');
    }
}
