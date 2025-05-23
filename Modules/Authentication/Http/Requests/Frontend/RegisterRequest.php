<?php

namespace Modules\Authentication\Http\Requests\Frontend;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name'               => 'required',
            'mobile'             => 'required|unique:users,mobile',
            'email'              => 'required|email|unique:users,email',
            'password'           => 'required|confirmed|min:8',
            'gender'             => 'nullable',
            'birthday'           => 'nullable|date|before_or_equal:today',
            // 'academic_year_id'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'           => __('user::api.users.validation.name.required'),
            'email.required'          => __('user::api.users.validation.email.required'),
            'email.unique'            => __('user::api.users.validation.email.unique'),
            'mobile.required'         => __('user::api.users.validation.mobile.required'),
            'mobile.unique'           => __('user::api.users.validation.mobile.unique'),
            'mobile.numeric'          => __('user::api.users.validation.mobile.numeric'),
            'mobile.digits_between'   => __('user::api.users.validation.mobile.digits_between'),
            'password.required'       => __('user::api.users.validation.password.required'),
            'password.min'            => __('user::api.users.validation.password.min'),
            'password.same'           => __('user::api.users.validation.password.same'),
        ];
    }
}
