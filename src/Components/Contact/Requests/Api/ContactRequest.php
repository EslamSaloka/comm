<?php

namespace App\Components\Contact\Requests\Api;

use App\Components\Helpers\JsonFormRequest;

class ContactRequest extends JsonFormRequest
{

    protected $errorBag = 'form';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id'   => 'required|numeric|exists:contact_type,id',
            'name'      => 'required|max:100',
            'email'     => 'required|email',
            // 'phone'     => ['required','regex:/^(\+?|0?)?(966)?(0)?(5([0-9]{1}))[0-9]{7}$/'],
            'phone'     => 'required',
            'message'   => 'required|max:400'
        ];
    }
}
