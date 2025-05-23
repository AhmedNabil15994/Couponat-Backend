<?php

namespace Modules\Authentication\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Traits\Api\Response;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => 'required',
            'password'        => 'nullable|min:6|same:password_confirmation',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $v = [
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

        return $v;
    }
}
