<?php

namespace App\Components\Common\Controller\Dashboard;

use Illuminate\Http\Request;
use App\Components\Controller;

class DashboardController extends Controller {

    public function index() {
        return view('Common::index', get_defined_vars());
    }

    public function profile() {
        return view('Common::profile', get_defined_vars());
    }

    public function profile_update() {
        return redirect()->back();
    }

}
