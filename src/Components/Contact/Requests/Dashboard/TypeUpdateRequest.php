<?php

namespace App\Components\Contact\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TypeUpdateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function attributes() {
        return [
            'ar.name'               => __('Type Name'),
            'en.name'               => __('Type Name'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'ar.name'       => 'required|string|max:150',
            'en.name'       => 'required|string|max:150',
        ];
        return $rules;
    }

}
