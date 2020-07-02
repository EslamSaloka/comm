<?php

namespace App\Components\Country\Controller\Front;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Country\Model\Country;

class FrontController extends Controller
{   
    public function index() {
        $lists = Country::paginate();
        return view('this::index',get_defined_vars());
    }
    
    public function create() {
        return view('this::create',get_defined_vars());
    }
    
    public function store(request $request) {
        Country::create($request->all());
        return redirect()->route('dashboard.country.index');
    }
    
    public function show(Country $country) {
        return view('this::show',get_defined_vars());
    }
    
    public function edit(request $request,Country $country) {
        return view('this::edit',get_defined_vars());
    }
    
    public function update(request $request,Country $country) {
        $country->update($request->all());
        return redirect()->back();
    }
    
    public function destroy(Country $country) {
        $country->delete();
        return redirect()->back();
    }
}
