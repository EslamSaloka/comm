<?php

namespace App\Components\Option\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Option\Model\Option;

class DashboardController extends Controller {

    public function index() {
        $array = [
            [
                'name'  =>  __('Options'),
                'route' =>  'option.index',
            ]
        ];
        $lists = Option::generator_map();
        return view('this::index', get_defined_vars());
    }

    public function create() {
        return view('this::create', get_defined_vars());
    }

    public function store(request $request) {
        Option::create($request->all());
        return redirect()->route('dashboard.option.index')->with('success' , __("Created successfully"));
    }

    public function show(Option $option) {
        return view('this::show', get_defined_vars());
    }

    public function edit(request $request, $group_by) {
        $map = Option::generator_map();
        $options = $map[$group_by];
        $array = [
            [
                'name'  =>  __('Options'),
                'route' =>  'option.index',
            ],
            [
                'name'  =>  __($options['title']),
                'route' =>  'option.create',
            ],
        ];
        return view('this::edit', get_defined_vars());
    }

    public function update(Request $request, $group_by) {
        $request_data = $request->except('_token', '_method');
        Option::insert_or_update($request_data, $group_by);
        return redirect()->back()->with('success',__("Updated successfully"));
    }

    public function destroy(Option $option) {
        $option->delete();
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }

}
