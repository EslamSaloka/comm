<?php

namespace App\Components\Option\Controller\Front;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Option\Model\Option;

class FrontController extends Controller {

    public function index() {
        $lists = Option::generator_map()['standard']['items'];
        return view('this::index', get_defined_vars());
    }

}
