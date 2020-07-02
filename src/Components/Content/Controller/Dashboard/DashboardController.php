<?php

namespace App\Components\Content\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Content\Model\Content;
use App\Components\Content\Requests\Admin\ContentRequest;

class DashboardController extends Controller {

    public function index() {
        $array = [
            [
                'name'  =>  __('Content'),
                'route' =>  'content.index',
            ]
        ];
        $new = [
            'route'=>'content.create',
            'label'=>'New Content',
            'icon' =>'icon-plus3',
        ];
        $lists = Content::paginate();
        return view('this::index', get_defined_vars());
    }

    public function create() {
        $array = [
            [
                'name'  =>  __('Content'),
                'route' =>  'content.index',
            ],
            [
                'name'  =>  __('New Content'),
                'route' =>  'content.create',
            ],
        ];
        $new = [
            'route'=>'content.index',
            'label'=>'Back to contents',
            'icon' =>'icon-arrow-left32',
        ];
        return view('this::create', get_defined_vars());
    }

    public function store(ContentRequest $request) {
        Content::generator_map();
        return redirect()->route('dashboard.content.index')->with('success' , __("Created successfully"));
    }

    public function show() {
        return view('this::show', get_defined_vars());
    }

    public function edit(Request $request, Content $content) {
        $array = [
            [
                'name'  =>  __('Content'),
                'route' =>  'content.index',
            ],
            [
                'name'  =>  __('Update Content'),
                'route' =>  'content.create',
            ],
        ];
        $new = [
            'route'=>'content.index',
            'label'=>'Back to contents',
            'icon' =>'icon-arrow-left32',
        ];
        return view('this::edit', get_defined_vars());
    }

    public function update(ContentRequest $request, Content $content) {
        Content::generator_map('update', $content);
        return redirect()->back()->with('success',__("Updated successfully"));
    }

    public function destroy(Content $content) {
        $content->delete();
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }

}
