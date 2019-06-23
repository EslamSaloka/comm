<?php

namespace Tasawk\TasawkComponent\User\Controller\Front;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\User;
use session;

class FrontController extends Controller {

    public function index() {
        return view('this::tabs.profile', get_defined_vars());
    }

    public function create() {
        return view('this::create', get_defined_vars());
    }

    public function store(Request $request) {
        User::createFromRequest();
        return redirect()->route('user.index');
    }

    public function show() {
        return view('this::index', get_defined_vars());
    }

    public function edit(request $request, User $user) {
        return view('this::edit', get_defined_vars());
    }

    public function update(Request $request, User $user) {
        $user->updateFromRequest();
        return redirect()->back()->with('blade_error', blade_request_message(__('Profile Updated'), 'success'));
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->back();
    }

    public function login(Request $request) {
        if ($request->isMethod('get')) {
            return ['status' => 0, 'method' => 'Post!', 'keys' => 'phone'];
        }
        $request = $request->all();
        $user = User::where('mobile', sanitize_mobile($request['phone']))->first();
        if (is_null($user)) {
            return ['status' => 0, 'message' => __('this mobile not found')];
        } else {
            if ($user->status == 0) {
                return ['status' => 0, 'message' => __('Sorry Your Account Is Blocked')];
            }
            $user->smsLogin();
            if(env('APP_DEBUG') == false) {
                return ['status' => 1, 'message' => __('Please Check Your Phone')];
            }
            return ['status' => 1, 'message' => __('Please Check Your Phone'),'actived_code'=>$user->actived_code];
        }
    }

    public function login_auth(Request $request) {
        if ($request->isMethod('get')) {
            return ['status' => 0, 'method' => 'Post!', 'keys' => ['phone', 'code']];
        }
        $request = $request->all();
        $user = User::where(
                        [
                            'mobile' => sanitize_mobile($request['phone']),
                            'actived_code' => $request['code'],
                        ]
                )->first();
        if (is_null($user)) {
            return ['status' => 0, 'message' => __('actived code wrong')];
        } else {
            \Auth::login($user);
            return ['status' => 1, 'message' => __('Welcome Back')];
        }
    }
    
    public function register_view() {
        if(\Auth::user()) {
            return redirect()->route('home');
        }
        return view('this::create', get_defined_vars());
    }

    public function register(UserRequest $request) {
        // dd('dsds');  
        $user = User::createUser($request->all());
        $user->smsLogin();
        $request->session()->put('mobile', $user->mobile);
        return redirect()->route('open_account')->with('blade_error', blade_request_message(__('Please Check Your Phone'), 'info'));
    }

}
