<?php

namespace App\Components\Locale\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;;

class DashboardController extends Controller {

    public function index() {
        $array = [
            [
                'name'  =>  __('Locale'),
                'route' =>  'locale.index',
            ]
        ];
        return view('this::index', get_defined_vars());
    }

    public function create() {
        return view('this::create', get_defined_vars());
    }

    public function store(request $request) {
        $data = [];
        foreach (request('locale') as $value) {
            $data[$value['index']] = $value['title'];
        }
        file_put_contents(resource_path('lang/ar.json'), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return 1;
    }

    public function show($locale) {
        $locals = json_decode(trim(file_get_contents(resource_path('lang/ar.json'))));
        $locle = [];
        foreach ($locals as $k => $v) {
            $locle[] = [
                'index' => $k,
                'title' => $v
            ];
        }
        return $locle;
    }

    public function edit(request $request, Locale $locale) {
        return view('this::edit', get_defined_vars());
    }

    public function update(request $request, Locale $locale) {
        $locale->update($request->all());
        return redirect()->back()->with('success' , __("Updated successfully"));
    }

    public function destroy(Locale $locale) {
        $locale->delete();
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }

}
