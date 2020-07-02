<?php

namespace App\Components\Content\Controller\Front;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Content\Model\Content;

class FrontController extends Controller {

    public function index() {
        $lists = Content::paginate();
        return view('this::index', get_defined_vars());
    }

    public function create() {
        return view('this::create', get_defined_vars());
    }

    public function store(request $request) {
        Content::create($request->all());
        return redirect()->route('app.content.index');
    }

    public function show(Content $content) {
        if($content->status == 0) {
            abort(404);
        }
        return view('this::show', get_defined_vars());
    }

    public function edit(request $request, Content $content) {
        return view('this::edit', get_defined_vars());
    }

    public function update(request $request, Content $content) {
        $content->update($request->all());
        return redirect()->back()->with('success' , __("Updated successfully"));
    }

    public function destroy(Content $content) {
        $content->delete();
        return redirect()->back()->with('success' , __('Deleted successfully'));
    }

}
