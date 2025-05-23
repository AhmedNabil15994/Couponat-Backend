<?php

namespace Modules\User\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'        => 'nullable|min:8|same:password_confirmation',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $v = [
            'password.required'       => __('user::api.users.validation.password.required'),
            'password.min'            => __('user::api.users.validation.password.min'),
            'password.same'           => __('user::api.users.validation.password.same'),
        ];

        return $v;
    }
}
