<?php

namespace App\Components\Helpers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Tasawk\TasawkComponent\Common\Support\API;

abstract class JsonFormRequest extends LaravelFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if (request()->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            $list = [];
            foreach ($errors as $key => $error) {
                $list[$key] = $error[0] ?? '';
            }

            throw new HttpResponseException(
                (new API())->setMessage(__('Invalid data'))
                    ->setErrors($list)
                    ->formatErrors()
                    ->setStatusError()
                    ->build()
            );
        } else {
            parent::failedValidation($validator);
        }
    }
}
