<?php

namespace App\Components\Contact\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Contact\Model\Type;
use App\Components\Contact\Requests\Dashboard\TypeStoreRequest;
use App\Components\Contact\Requests\Dashboard\TypeUpdateRequest;

class TypeController extends Controller {

    public function index() {
        $array = [
            [
                'name'  =>  __('Contact types'),
                'route' =>  'contact.type.index',
            ]
        ];
        $new = [
            'route'=>'contact.type.create',
            'label'=>'Add New Contact types',
            'icon' =>'icon-plus3',
        ];
        $lists = Type::orderBy('id','DESC')->paginate();
        return view('this::type.index', get_defined_vars());
    }

    public function create() {
        $array = [
            [
                'name'  =>  __('Contact types'),
                'route' =>  'contact.type.index',
            ],
            [
                'name'  =>  __('New Contact type'),
                'route' =>  'contact.type.create',
            ],
        ];
        $new = [
            'route'=>'contact.type.index',
            'label'=>'Back to contact types',
            'icon' =>'icon-arrow-left32',
        ];
        return view('this::type.create', get_defined_vars());
    }

    public function store(request $request) {
        Type::create(request()->all());
        return redirect()->route('dashboard.contact.type.index')->with('success' , __("Created successfully"));
    }

    public function show() {
        return view('this::type.show', get_defined_vars());
    }

    public function edit(request $request, Type $type) {
        $array = [
            [
                'name'  =>  __('Contact types'),
                'route' =>  'contact.type.index',
            ],
            [
                'name'  =>  __('Edit Type :NAME',['NAME'=>$type->name]),
                'route' =>  'contact.type.create',
            ],
        ];
        $new = [
            'route'=>'contact.type.index',
            'label'=>'Back to contact types',
            'icon' =>'icon-arrow-left32',
        ];
        return view('this::type.edit', get_defined_vars());
    }

    public function update(request $request, Type $type) {
        $type->update(request()->all());
        return redirect()->back()->with('success',__("Updated successfully"));
    }

    public function destroy(Type $type) {
        $type->delete();
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }

}
