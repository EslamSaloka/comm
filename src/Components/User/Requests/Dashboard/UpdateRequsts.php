<?php

namespace App\Components\User\Requests\Dashboard;

use App\Components\Helpers\JsonFormRequest;

class UpdateRequsts extends JsonFormRequest
{
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
        $rules = [
            'name'          => 'required|min:6|max:30',
            'email'         => 'required|email|unique:users,email,'.$this->user->id,
            'phone'         => 'required|numeric',
            'country_id'    => 'required|numeric|exists:countries,id',
        ];
        if(request()->has('image')) {
            $rules['image'] = 'required|image';
        }
        if(request()->has('password') && !is_null(request('password'))) {
            $rules['password'] = 'sometimes|min:6';
        }
        return $rules;
    }
}
