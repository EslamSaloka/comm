<?php

namespace App\Components\Contact\Controller\Api;

use Tasawk\TasawkComponent\Controller;;

use App\Components\Rules;
use App\Components\Contact\Requests\Api\ContactRequest;
use Tasawk\TasawkComponent\Common\Support\API;
use App\Components\Contact\Model\Contact;
use App\Components\Contact\Model\Type;
use App\Components\Contact\Resources\Api\TypeResources;

class ApiController extends Controller
{

    public function index() {
        $data = Type::listsTranslations('name')->orderBy('id','DESC')->get();
        return (new API())->setMessage(__('Contact Types'))
            ->setData(TypeResources::collection($data))
            ->setStatusOK()
            ->build();
    }

    public function store(ContactRequest $request)
    {
        Contact::create($request->all());
        return (new API())->setMessage(__('Your message sent successfully'))
            ->setStatusOK()
            ->build();
    }
}
