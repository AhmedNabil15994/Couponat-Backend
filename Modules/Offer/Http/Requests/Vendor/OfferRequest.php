<?php

namespace Modules\Offer\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            // handle creates
            case 'post':
            case 'POST':

                return [
                    'title.*' => 'required',
                    'discount_title' => 'required',
                    'discount_desc.*' => 'required',
                    'price' => 'required',
                    'seller_id' => 'required|exists:users,id',
                    'category_id' => 'required',
                    'description.*' => 'nullable',
                    'details.*' => 'nullable',
                    'start_at' => 'nullable',
                    'expired_at' => 'nullable',
                    'main_image'    => 'required',
                    'user_valid_from'    => 'required',
                    'user_valid_until'    => 'required',
                    'city_id'    => 'required|exists:cities,id',
                    'state_id'    => 'required|exists:states,id',
                    'lat'    => 'required',
                    'lng'    => 'required',
                    'address_link'  => 'nullable',

                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*' => 'required',
                    'discount_title' => 'required',
                    'discount_desc.*' => 'required',
                    'price' => 'required',
                    'seller_id' => 'required|exists:users,id',
                    'category_id' => 'required|exists:categories,id',
                    'start_at' => 'nullable',
                    'description.*' => 'nullable',
                    'details.*' => 'nullable',
                    'expired_at' => 'nullable',
                    'user_valid_from'    => 'required',
                    'user_valid_until'    => 'required',
                    'city_id'    => 'required|exists:cities,id',
                    'state_id'    => 'required|exists:states,id',
                    'lat'    => 'required',
                    'lng'    => 'required',
                    'address_link'  => 'nullable',
                ];
        }
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
            'title.required' => __('coupon::dashboard.coupons.validation.title.required'),
            'discount_title.required' => __('coupon::dashboard.coupons.validation.discount_title.required'),
            'discount_desc.required' => __('coupon::dashboard.coupons.validation.discount_desc.required'),
            'price.required' => __('coupon::dashboard.coupons.validation.price.required'),
            'seller_id.required' => __('coupon::dashboard.coupons.validation.seller_id.required'),
            'category_id.required' => __('coupon::dashboard.coupons.validation.category_id.required'),
            'main_image.required' => __('coupon::dashboard.coupons.validation.main_image.required'),
            'city_id.required' => __('coupon::dashboard.coupons.validation.city_id.required'),
            'state_id.required' => __('coupon::dashboard.coupons.validation.state_id.required'),
            'lat.required' => __('coupon::dashboard.coupons.validation.lat.required'),
            'lng.required' => __('coupon::dashboard.coupons.validation.lng.required'),
        ];
        return $v;
    }
}
