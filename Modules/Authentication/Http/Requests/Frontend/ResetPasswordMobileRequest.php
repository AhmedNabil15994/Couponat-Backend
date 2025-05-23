<?php

namespace Modules\Authentication\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordMobileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "code"              => "required",
            "password"                 => "required|min:6",
            'password_confirmation'        => 'required|min:6|same:password',  
            "phone_code"        => "required",
            'mobile'            => ['required','numeric','digits_between:3,20',Rule::exists("users", "mobile")->where(function($query){
                $query->where("phone_code", $this->phone_code);
             })]
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
            'email.required'      =>   __('authentication::api.password.validation.email.required'),
            'email.email'         =>   __('authentication::api.password.validation.email.email'),
            'email.exists'        =>   __('authentication::api.password.validation.email.exists'),
        ];

        return $v;
    }
}
