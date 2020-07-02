<?php

namespace App\Components\Option\Controller\Api;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use Tasawk\TasawkComponent\Common\Support\API;
use App\Components\Option\Model\Option;

class ApiController extends Controller {

    public function index() {
        if(empty(request()->all())) {
            $array = [];
            foreach(Option::generator_map() as $key=>$value) {
                $array[] = [
                    'key'=>$key,
                    'value'=>__($value['title']),
                ];
            }
            return (new API())->setMessage(__('Setting Types'))
                ->setErrors($array)
                ->setStatusError()
                ->build();
        }
        if(request()->has('type') && !is_null(request('type'))) {
            if(array_key_exists(request('type'),Option::generator_map())) {
                $list = Option::where('group_by',request('type'))->pluck('value', 'key')->all();
                $array = [];
                foreach ($list as $key => $val) {
                    $array[$key] = (is_array(json_decode($val, true))) ? $this->fillterArray(json_decode($val, true)) : $this->fillterString($val);
                }
                return (new API())->setMessage(__('App Setting'))
                    ->setData($array)
                    ->setStatusOk()
                    ->formatErrors()
                    ->build();
            }
            $error = ['key'=>'type','value'=>'This type not fount'];
            return (new API())->setMessage(__('Setting Types'))
                ->setErrors([$error])
                ->setStatusError()
                ->build();
        }
        $error = ['key'=>'type','value'=>'Type not fount'];
        return (new API())->setMessage(__('Setting Types'))
                ->setErrors([$error])
                ->setStatusError()
                ->build();
    }

    public function fillterArray($array) {
        $translate = [];
        foreach ($array as $val) {
            $translate[] = $val[\App::getLocale()];
        }
        return $translate;
    }

    public function fillterString($string) {
        $jpg = [
            'jpg',
            'jpeg',
            'png',
        ];
        foreach ($jpg as $item) {
            if (strpos($string, $item) !== false) {
                $string = url($string);
            }
        }
        return $string;
    }



}
