<?php

namespace App\Components\Admins\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdadateAdminRequest extends FormRequest {

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
            'condition.name'        => __('name'),
            // 'condition.phone'      => __('phone'),
            'condition.email'       => __('email'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'name'     => 'required|string|max:150',
            // 'phone'   => 'required|string|max:150',
            'email'    => 'required|email',
        ];
        return $rules;
    }

}
