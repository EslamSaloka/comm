<?php

namespace App\Components\Country\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Country\Model\Country;
use App\Components\Country\Requests\Dashboard\StoreRequest;
use App\Components\Country\Requests\Dashboard\UpdateRequest;

class DashboardController extends Controller
{   
    public function index() {
        $array = [
            [
                'name'  =>  __('Countries'),
                'route' =>  'country.index',
            ]
        ];
        $new = [
            'route'=>'country.create',
            'label'=>'Add New Country',
            'icon' =>'icon-plus3',
        ];
        $lists = Country::where(['parent'=>0])->paginate();
        return view('this::index',get_defined_vars());
    }

    public function show(Country $country) {
        $array = [
            [
                'name'  =>  __('Countries'),
                'route' =>  'country.index',
            ]
        ];
        $new = [
            'route'=>'country.create',
            'label'=>'Add New Country',
            'icon' =>'icon-plus3',
        ];
        $lists = Country::where(['parent'=>$country->id])->paginate();
        return view('this::index',get_defined_vars());
    }
    
    public function create() {
        $array = [
            [
                'name'  =>  __('Countries'),
                'route' =>  'country.index',
            ],
            [
                'name'  =>  __('New Country'),
                'route' =>  'country.create',
            ],
        ];
        $new = [
            'route'=>'country.index',
            'label'=>'Back to countries',
            'icon' =>'icon-arrow-left32',
        ];
        $countries = Country::where(['parent'=>0])->get();
        return view('this::create',get_defined_vars());
    }
    
    public function store(StoreRequest $request) {
        $request = $request->all();
        if(request()->has('image') && !is_null(request('image'))) {
            $request['image'] = file_upload($request['image'],'countries');
        } else {
            $request['image'] = '';
        }
        Country::create($request);
        return redirect()->route('dashboard.country.index')->with('success',__("Created successfully"));
    }
    
    public function edit(request $request,Country $country) {
        $array = [
            [
                'name'  =>  __('Countries'),
                'route' =>  'country.index',
            ],
            [
                'name'  =>  __('Edit Country :NAME',['NAME'=>$country->name]),
                'route' =>  'country.edit',
            ],
        ];
        $new = [
            'route'=>'country.index',
            'label'=>'Back to countries',
            'icon' =>'icon-arrow-left32',
        ];
        $countries = Country::where(['parent'=>0])->get();
        return view('this::edit',get_defined_vars());
    }
    
    public function update(UpdateRequest $request,Country $country) {
        $request = $request->all();
        if(request()->has('image') && !is_null(request('image'))) {
            $request['image'] = file_upload($request['image'],'countries');
        }
        $country->update($request);
        return redirect()->back()->with('success',__("Updated successfully"));
    }
    
    public function destroy(Country $country) {
        $country->delete();
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }
}
