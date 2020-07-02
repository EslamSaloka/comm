<?php

namespace App\Components\User\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\User\Requests\Dashboard\CreateRequsts;
use App\Components\User\Requests\Dashboard\UpdateRequsts;
use App\Components\Country\Model\Country;
use App\User;

class DashboardController extends Controller
{   
    public function index() {
        $array = [
            [
                'name'  =>  __('Users'),
                'route' =>  'user.index',
            ]
        ];
        $new = [
            'route'=>'user.create',
            'label'=>'Add New user',
            'icon' =>'icon-plus3',
        ];
        $lists = User::where(['type'=>'client'])->paginate();
        return view('this::index',get_defined_vars());
    }
    
    public function create() {
        $array = [
            [
                'name'  =>  __('Users'),
                'route' =>  'user.index',
            ],
            [
                'name'  =>  __('New user'),
                'route' =>  'user.create',
            ],
        ];
        $new = [
            'route'=>'user.index',
            'label'=>'Back to users',
            'icon' =>'icon-arrow-left32',
        ];
        $countries = Country::all();
        return view('this::create',get_defined_vars());
    }
    
    public function store(CreateRequsts $request) {
        $user = User::createForm($request->all());
        if($user['status'] == 0) {
            return redirect()->back()->with('danger',$user['error']);
        }
        return redirect()->route('dashboard.user.index')->with('success',__("Created successfully"));
    }
    
    public function show(User $user) {
        return view('this::show',get_defined_vars());
    }
    
    public function edit(request $request,User $user) {
        $array = [
            [
                'name'  =>  __('Users'),
                'route' =>  'user.index',
            ],
            [
                'name'  =>  __('Edit user'),
                'route' =>  'user.create',
            ],
        ];
        $new = [
            'route'=>'user.index',
            'label'=>'Back to users',
            'icon' =>'icon-arrow-left32',
        ];
        $countries = Country::all();
        return view('this::edit',get_defined_vars());
    }
    
    public function update(UpdateRequsts $request,User $user) {
        $check = User::UpdateForm($request->all(),$user);
        if($check['status'] == 0) {
            return redirect()->back()->with('danger',$check['error']);
        }
        return redirect()->back()->with('success',__("Updated successfully"));
    }
    
    public function destroy(User $user) {
        $user->delete();
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }
}
