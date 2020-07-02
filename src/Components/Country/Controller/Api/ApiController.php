<?php

namespace App\Components\Country\Controller\Api;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use Tasawk\TasawkComponent\Common\Support\API;
use App\Components\Country\Model\Country;

class ApiController extends Controller
{   
    public function index() {
        $lists = Country::orderBy('id','DESC')->paginate();
        return (new API())->setMessage(__('Countries List'))
            ->setData(ResCountry::collection($lists))
            ->addAttribute('paginate',api_model_set_pagenation($lists))
            ->setStatusOK()
            ->build();
    }
}
