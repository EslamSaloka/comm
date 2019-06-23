<?php

namespace App\Components\Common\Controller\Front;

use App\Components\Controller;
use App\Components\Product\Model\Product;

class Index extends Controller {

    public function __invoke() {
        // $product = Product::paginate(2);
        $product = Product::regular()->with('translations')->get();
        return view('this::home', get_defined_vars());
    }

}
