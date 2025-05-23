<?php

namespace Modules\Authentication\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|exists:users,email|email',
            'password'    => 'required|min:8',
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
             'email.required'      =>   __('authentication::frontend.login.validations.email.required'),
             'email.email'         =>   __('authentication::frontend.login.validations.email.email'),
             'password.required'   =>   __('authentication::frontend.login.validations.password.required'),
             'password.min'        =>   __('authentication::frontend.login.validations.password.min'),
         ];

         return $v;
     }
}
