
{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
    <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
        id="first_{{$code}}">
        {!! field()->text('title['.$code.']',
        __('faq::dashboard.faqs.form.title').'-'.$code ,
        $model->getTranslation('title',$code),
        ['data-name' => 'title.'.$code]
        ) !!}
        <div class="form-group">
            <label for="" class="col-md-2">{{__('faq::dashboard.faqs.form.description').'-'.$code}}</label>
            <div class="col-md-9">
                <textarea name="description[{{$code}}]" rows="8" cols="80" class="form-control {{is_rtl($code)}}Editor" data-name="description.{{$code}}">{{ $model->description }}</textarea>
                <div class="help-block"></div>
            </div>
        </div>

    </div>
    @endforeach
</div>



{!! field()->number('order', __('faq::dashboard.faqs.form.order')) !!}
{{--{!! field()->file('image', __('faq::dashboard.faqs.form.image'), $model->getFirstMediaUrl('images')) !!}--}}
{!! field()->checkBox('status', __('faq::dashboard.faqs.form.status')) !!}

@if ($model->trashed())
{!! field()->checkBox('trash_restore', __('faq::dashboard.faqs.form.restore')) !!}
@endif



@push('scripts')
<script>
    $('input[name=type]').change(function () {
            $('.hide-inputs').hide();
            $('#' + this.value + '-input').show();
        });
        $('#add_dates').change(function () {
            if (this.checked) {
                $('#dates_container').show();
            }else{

                $('#dates_container').hide();
            }
        });
</script>
@endpush
