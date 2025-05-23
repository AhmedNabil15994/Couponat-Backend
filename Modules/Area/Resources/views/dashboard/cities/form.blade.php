@inject('countries' ,'Modules\Area\Entities\Country')

{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('category::dashboard.categories.form.title').'-'.$code ,
                    $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>
{!! field()->select('country_id',__('area::dashboard.cities.form.countries'),$countries->pluck('title','id')->toArray()) !!}
{!! field()->checkBox('status', __('category::dashboard.categories.form.status')) !!}
@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('category::dashboard.categories.form.restore')) !!}
@endif