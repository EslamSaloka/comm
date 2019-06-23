<?php

namespace Tasawk\TasawkComponent\User\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\User;

class DashboardController extends Controller {

    public function index() {
        $lists = User::where('type', 'user')->paginate();
        return view('this::index', get_defined_vars());
    }

    public function create() {
        return view('this::create', get_defined_vars());
    }

    public function store(UserRequest $request) {
        $create_data = $request->except(['password']);
        $create_data['password'] = \Hash::make($request['password']);
        User::create($create_data);
        return redirect()->route('dashboard.users.index');
    }

    public function show(User $user) {
        return view('this::show', get_defined_vars());
    }

    public function edit(Request $request, User $user) {
        return view('this::edit', get_defined_vars());
    }

    public function update(UserRequest $request, User $user) {
        $update_data = $request->except(['password']);
        if ($request['password']) {
            $update_data['password'] = \Hash::make($request['password']);
        }
        if (request()->has('status')) {
            $update_data['status'] = (request('status') == 'on') ? 1 : 0;
        }
        $user->update($update_data);
        return redirect()->back();
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->back();
    }

}
