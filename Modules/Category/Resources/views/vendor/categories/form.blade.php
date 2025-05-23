
{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('category::vendor.categories.form.title').'-'.$code ,
                    $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>


<div class="form-group">
    <label class="col-md-2">
        {{__('category::vendor.categories.form.color')}}
    </label>
    <div class="col-md-3">
        <input type="color" name="color" class="form-control" data-name="color" value="{{$model && $model->color ?? "#1888c9"}}">
        <div class="help-block"></div>
    </div>
</div>

{!! field()->file('image', __('category::vendor.categories.form.image'), $model && $model->getFirstMediaUrl('images') ? : '') !!}
{!! field()->checkBox('status', __('category::vendor.categories.form.status')) !!}
@if ($model && $model->trashed())
    {!! field()->checkBox('trash_restore', __('category::vendor.categories.form.restore')) !!}
@endif
{!! Form::hidden('category_id' , null ,['id' => 'root_category']) !!}
