<?php

namespace Modules\User\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificationRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->getMethod())
        {
            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'from'                      => 'required',
                    'certificat'                => 'required',
                    'address'                   => 'required',
                    'hours'                     => 'required',
                ];
        }
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $v = [
            'name.required'           => __('user::api.users.validation.name.required'),
        ];

        return $v;
    }
}
