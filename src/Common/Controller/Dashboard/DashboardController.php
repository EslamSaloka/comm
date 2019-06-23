<?php

namespace Tasawk\TasawkComponent\Common\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;

class DashboardController extends Controller {

    public function index() {
        return view('DCommon::index', get_defined_vars());
    }

    public function profile() {
        return view('DCommon::profile', get_defined_vars());
    }

    public function profile_update() {
        return redirect()->back();
    }

}
