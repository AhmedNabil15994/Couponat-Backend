<?php

namespace Modules\Area\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
                  'country_id'      => 'required|exists:countries,id',
                  'title'         => 'required',
                  'title.*'         => 'required|unique:cities,title',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'country_id'      => 'required|exists:countries,id',
                    'title'         => 'required',
                    'title.*'         => 'required|unique:cities,title,'.$this->id.',id',
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
          'country_id.required'        => __('area::dashboard.cities.validation.country_id.required'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["title.".$key.".required"]  = __('area::dashboard.cities.validation.title.required').' - '.$value['native'].'';

          $v["title.".$key.".unique"]    = __('area::dashboard.cities.validation.title.unique').' - '.$value['native'].'';

        }

        return $v;

    }
}
