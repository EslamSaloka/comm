<?php

namespace App\Components\Contact\Controller\Dashboard;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;;
use App\Components\Contact\Model\Type;
use App\Components\Contact\Model\Contact;

class DashboardController extends Controller
{

    public function index()
    {
        $array = [
            [
                'name'  =>  __('Contacts'),
                'route' =>  'contact.index',
            ]
        ];
        $lists = Contact::Listing();
        $types = Type::all();
        return view('this::index', get_defined_vars());
    }

    public function create()
    {
        return view('this::create', get_defined_vars());
    }

    public function store(request $request)
    {
        Contact::create($request->all());
        return redirect()->route('dashboard.contact.index')->with('success', __("Created successfully"));
    }

    public function show(Contact $contact)
    {
        $array = [
            [
                'name'  =>  __('Contacts'),
                'route' =>  'contact.index',
            ],
            [
                'name'  =>  __('Show Contact'),
                'route' =>  'contact.index',
            ],
        ];
        $new = [
            'route'=>'contact.index',
            'label'=>'Back to contacts',
            'icon' =>'icon-arrow-left32',
        ];
        $contact->update([
            'seen' => 1
        ]);
        return view('this::show', get_defined_vars());
    }

    public function edit(request $request, Contact $contact)
    {
        return view('this::edit', get_defined_vars());
    }

    public function update(request $request, Contact $contact)
    {
        $contact->update($request->all());
        return redirect()->back()->with('success', __("Updated successfully"));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', __('Deleted successfully'));
    }
}
