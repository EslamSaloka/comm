<?php

namespace App\Components\Admins\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Admins\Model\Admin;
use App\Components\Admins\Requests\Admin\AdminRequest;
use App\Components\Admins\Requests\Admin\UpdadateAdminRequest;

class DashboardController extends Controller {

    public function index() {
        $array = [
            [
                'name'  =>  __('Admins'),
                'route' =>  'admin.index',
            ]
        ];
        $new = [
            'route'=>'admin.create',
            'label'=>'Add New Admin',
            'icon' =>'icon-plus3',
        ];
        $lists = Admin::where('id','!=',\Auth::user()->id)->orderBy('id','DESC')->paginate();
        return view('this::index', get_defined_vars());
    }

    public function create() {
        $array = [
            [
                'name'  =>  __('Admins'),
                'route' =>  'admin.index',
            ],
            [
                'name'  =>  __('Create Admin'),
                'route' =>  'admin.create',
            ],
        ];
        $new = [
            'route'=>'admin.index',
            'label'=>'Back to admins',
            'icon' =>'icon-arrow-left32',
        ];
        return view('this::create', get_defined_vars());
    }

    public function store(AdminRequest $request) {
        Admin::createdAdmin($request->all());
        return redirect()->route('dashboard.admin.index')->with('success' , __("Created successfully"));
    }

    public function show(Admin $admin) {
        return view('this::show', get_defined_vars());
    }

    public function edit(request $request,Admin $admin) {
        $array = [
            [
                'name'  =>  __('Admins'),
                'route' =>  'admin.index',
            ],
            [
                'name'  =>  __('Edit Admin :NAME',['NAME'=>$admin->name]),
                'route' =>  'admin.create',
            ],
        ];
        $new = [
            'route'=>'admin.index',
            'label'=>'Back to admins',
            'icon' =>'icon-arrow-left32',
        ];
        return view('this::edit', get_defined_vars());
    }

    public function update(UpdadateAdminRequest $request, Admin $admin) {
        Admin::updatedAdmin($admin,$request->all());
        return redirect()->back()->with('success',__("Updated successfully"));
    }

    public function destroy(Admin $admin) {
        if($admin->id != 1 && $admin->id != \Auth::user()->id) {
            $admin->delete();
        }
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }

}
