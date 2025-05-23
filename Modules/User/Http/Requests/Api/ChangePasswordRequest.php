<?php

namespace Modules\User\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Rule\Api\OldPasswordRule;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password'  => ['required_unless:type,forget' , new OldPasswordRule],
            'password'          => 'required|min:6|same:password_confirmation',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $v = [
            'current_password.required' => __('user::api.users.validation.current_password.required'),
            'password.required'         => __('user::api.users.validation.password.required'),
            'password.min'              => __('user::api.users.validation.password.min'),
            'password.same'             => __('user::api.users.validation.password.same'),
        ];

        return $v;
    }

}
