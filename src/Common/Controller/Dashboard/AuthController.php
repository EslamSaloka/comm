<?php

namespace App\Components\Common\Controller\Dashboard;

use App\Components\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller {

    public function login() {
        if (is_null(Auth::user())) {
            return view('Common::login', get_defined_vars());
        } else {
            return redirect()->route('dashboard.Dindex');
        }
    }

    public function loginAuth() {
        if (Auth::attempt(['name' => request('username'), 'password' => request('password'), 'type' => 'admin'])) {
            return redirect()->route('dashboard.Dindex');
        } else {
            return redirect()->route('login');
        }
    }

    public function Logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}
