<?php

namespace Modules\Setting\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
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
            'email.required'      =>   __('setting::dashboard.password.email.required'),
            'email.email'         =>   __('setting::dashboard.password.email.email'),
            'email.exists'        =>   __('setting::dashboard.password.email.exists'),
        ];

        return $v;
    }
}
