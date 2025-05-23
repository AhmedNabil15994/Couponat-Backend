<?php

namespace Modules\Area\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'state_id'         => 'required|exists:states,id',
                  'title'         => 'required',
                  'title.*'         => 'required|unique:areas,title',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'state_id'         => 'required|exists:states,id',
                    'title'         => 'required',
                    'title.*'         => 'required|unique:areas,title,'.$this->id.',id',
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
          'state_id.required'        => __('area::dashboard.areas.validation.state_id.required'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["title.".$key.".required"]  = __('area::dashboard.areas.validation.title.required').' - '.$value['native'].'';

          $v["title.".$key.".unique"]    = __('area::dashboard.areas.validation.title.unique').' - '.$value['native'].'';

        }

        return $v;

    }
}
