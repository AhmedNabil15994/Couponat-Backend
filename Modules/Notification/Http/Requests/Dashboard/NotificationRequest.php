<?php

namespace Modules\Notification\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                    'title.*' => 'required|max:255',
                    'body.*' => 'required|max:1000',
                    'send_at'   => 'required',

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
            'title.required' => __('notification::dashboard.notifications.validation.title.required'),
            'title.max' => __('notification::dashboard.notifications.validation.title.max'),
            'body.required' => __('notification::dashboard.notifications.validation.body.required'),
            'body.max' => __('notification::dashboard.notifications.validation.body.max'),

            'notification_type.required' => __('notification::dashboard.notifications.validation.notification_type.required'),
            'notification_type.in' => __('notification::dashboard.notifications.validation.notification_type.in') . ' : general,product,category',
            'product_id.required_if' => __('notification::dashboard.notifications.validation.product_id.required_if'),
            'category_id.required_if' => __('notification::dashboard.notifications.validation.category_id.required_if'),
        ];
        return $v;
    }
}
