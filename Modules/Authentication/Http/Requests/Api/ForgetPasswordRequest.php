<?php

namespace Modules\Authentication\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'calling_code' => 'required',
            'mobile'             => 'required|exists:users,mobile',
            'code' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $v = [
//            'email.required'      =>   __('authentication::api.password.validation.email.required'),
//            'email.email'         =>   __('authentication::api.password.validation.email.email'),
//            'email.exists'        =>   __('authentication::api.password.validation.email.exists'),
        ];

        return $v;
    }
}
