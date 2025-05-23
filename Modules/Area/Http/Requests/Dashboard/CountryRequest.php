<?php

namespace Modules\Area\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
                  'title'         => 'required',
                  'title.*'         => 'required|unique:countries,title',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title'          => 'required',
                    'title.*'          => 'required|unique:countries,title,'.$this->id.',id',
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

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["title.".$key.".required"]  = __('area::dashboard.countries.validation.title.required').' - '.$value['native'].'';

          $v["title.".$key.".unique"]    = __('area::dashboard.countries.validation.title.unique').' - '.$value['native'].'';

        }

        return $v;

    }
}
