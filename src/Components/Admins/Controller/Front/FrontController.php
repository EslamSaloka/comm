<?php

namespace App\Components\Admins\Controller\Front;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;;
use App\Components\Voucher\Model\Voucher;

class FrontController extends Controller {

    public function index() {
        $lists = Admin::paginate();
        return view('this::index', get_defined_vars());
    }

    public function create() {
        return view('this::create', get_defined_vars());
    }

    public function store(request $request) {
        Admin::create($request->all());
        return redirect()->route('dashboard.admin.index')->with('success' , __("Created successfully"));
    }

    public function show(Admin $admin) {
        return view('this::show', get_defined_vars());
    }

    public function edit(request $request, Admin $admin) {
        return view('this::edit', get_defined_vars());
    }

    public function update(request $request, Admin $admin) {
        $admin->update($request->all());
        return redirect()->back()->with('success' , __("Updated successfully"));
    }

    public function destroy(Admin $admin) {
        $admin->delete();
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }

}
