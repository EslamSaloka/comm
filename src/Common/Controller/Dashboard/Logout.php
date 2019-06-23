<?php

namespace App\Components\Common\Controller\Dashboard;

use App\Components\Controller;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller {

    public function __invoke() {
        Auth::logout();
        return redirect()->route('login');
    }

}
