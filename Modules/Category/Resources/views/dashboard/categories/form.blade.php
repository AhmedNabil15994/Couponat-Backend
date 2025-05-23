
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


<div class="form-group">
    <label class="col-md-2">
        {{__('category::dashboard.categories.form.color')}}
    </label>
    <div class="col-md-3">
        <input type="color" name="color" class="form-control" data-name="color" value="{{$model->color ?? "#1888c9"}}">
        <div class="help-block"></div>
    </div>
</div>

{!! field()->file('image', __('category::dashboard.categories.form.image'), $model->getFirstMediaUrl('images')) !!}
{!! field()->number('order', __('category::dashboard.categories.form.sort')) !!}
{!! field()->checkBox('status', __('category::dashboard.categories.form.status')) !!}
@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('category::dashboard.categories.form.restore')) !!}
@endif
{!! Form::hidden('category_id' , null ,['id' => 'root_category']) !!}
