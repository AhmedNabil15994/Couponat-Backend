<?php

namespace Modules\Order\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'state_id'             => auth()->check() ? 'required' : '',//'required_if:hasPaperNote,==,1',
//            'widget'               => auth()->check() ? 'required' : '',
//            'street'               => auth()->check() ? 'required' : '',
//            'building'             => auth()->check() ? 'required' : '',
//            'floor'                => 'required_if:hasPaperNote,==,1',
//            'flat'                 => 'required_if:hasPaperNote,==,1',
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
