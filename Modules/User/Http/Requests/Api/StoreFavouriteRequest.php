<?php

namespace Modules\User\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreFavouriteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            case 'post':
            case 'POST':
                return [
                    'offer_id' => 'required|exists:offers,id',
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
            'offer_id.required' => __('user::api.favourites.validation.product_id.required'),
            'offer_id.exists' => __('user::api.favourites.validation.product_id.exists'),
        ];

        return $v;
    }
}
