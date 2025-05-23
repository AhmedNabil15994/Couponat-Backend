<?php

namespace Modules\Authentication\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email|exists:users,email',
            'token'     => [
                'required',
                Rule::exists("password_resets")->where(function ($query) {
                    $query->where("token", $this->token)->where("email", $this->email);
                }),
            ],
            'password'  => 'required|confirmed|min:8',
        ];
    }
    // 'exists:password_resets,token'
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'email.required'          => __('user::api.users.validation.email.required'),
            'email.unique'            => __('user::api.users.validation.email.unique'),
            'password.required'       => __('user::api.users.validation.password.required'),
            'password.min'            => __('user::api.users.validation.password.min'),
            'password.confirmed'           => __('user::api.users.validation.password.same'),
        ];
    }
}
