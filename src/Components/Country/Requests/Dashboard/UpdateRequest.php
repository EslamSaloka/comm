<?php

namespace App\Components\Country\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest {

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
            'ar.name'                   => __('Country Arabic Name'),
            'en.name'                   => __('Country English Name'),
            'condition.image'           => __('Country Flag'),
            'condition.country_code'    => __('Country Code'),
            'condition.country_number'  => __('Country Number'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'ar.name'           => 'required|string|max:150',
            'en.name'           => 'required|string|max:150',
            'country_code'      => 'required|numeric',
            'country_number'    => 'required|numeric',
        ];
        if(request()->has('image')) {
            $rules['image'] = 'required|image';
        }
        return $rules;
    }

}
