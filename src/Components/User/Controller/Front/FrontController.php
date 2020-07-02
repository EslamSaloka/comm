<?php

namespace App\Components\User\Controller\Front;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\User\Model\User;

class FrontController extends Controller
{   
    public function index() {
        $lists = User::paginate();
        return view('this::index',get_defined_vars());
    }
    
    public function create() {
        return view('this::create',get_defined_vars());
    }
    
    public function store(request $request) {
        User::create($request->all());
        return redirect()->route('dashboard.user.index');
    }
    
    public function show(User $user) {
        return view('this::show',get_defined_vars());
    }
    
    public function edit(request $request,User $user) {
        return view('this::edit',get_defined_vars());
    }
    
    public function update(request $request,User $user) {
        $user->update($request->all());
        return redirect()->back();
    }
    
    public function destroy(User $user) {
        $user->delete();
        return redirect()->back();
    }
}
