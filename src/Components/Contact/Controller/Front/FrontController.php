<?php

namespace App\Components\Contact\Controller\Front;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;;
use App\Components\Contact\Model\Contact;
use App\Components\Contact\Requests\Front\ContactRequest;

class FrontController extends Controller {

    public function index() {
        return view('this::index', get_defined_vars());
    }

    public function store(ContactRequest $request) {
        Contact::create($request->all());
        return redirect()->route('contact.index')->with('blade_error', blade_request_message('Thank You', 'success'));
    }

}
