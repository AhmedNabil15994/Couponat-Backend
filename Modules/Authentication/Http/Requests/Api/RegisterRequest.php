<?php

namespace Modules\Authentication\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required',
            'email'       => 'required|confirmed|unique:users,email',
            'calling_code' => 'required',
            'mobile'             => 'required|unique:users,mobile',
            'password'    => 'required|confirmed|min:6',
            'birthday'        => 'nullable',
            'gender'        => 'nullable',
            'newsletter_subscribe'        => 'nullable',
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
}
