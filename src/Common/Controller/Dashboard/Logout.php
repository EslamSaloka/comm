<?php

namespace Tasawk\TasawkComponent\Common\Controller\Dashboard;

use Tasawk\TasawkComponent\Controller;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller {

    public function __invoke() {
        Auth::logout();
        return redirect()->route('login');
    }

}
