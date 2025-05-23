<?php

namespace Modules\Order\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OrderStatusRequest extends FormRequest
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
                  'color_label'     => 'required',
                  'title.*'         => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'color_label'      => 'required',
                    'title.*'          => 'required',
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
            'color_label.required'   => __('order::dashboard.order_statuses.validation.color_label.required'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {
            $v["title.".$key.".required"]  = __('order::dashboard.order_statuses.validation.title.required').' - '.$value['native'].'';

            $v["title.".$key.".unique"]    = __('order::dashboard.order_statuses.validation.title.unique').' - '.$value['native'].'';
        }

        return $v;
    }
}
