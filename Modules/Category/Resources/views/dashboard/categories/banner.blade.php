{!! field()->checkBox('banner_status', __('category::dashboard.categories.form.banner_status'), null,['checked' => $model->expired_at ? true : false]) !!}
<div class="bannerData {{ $model->expired_at ? '' : 'hidden'}}">
    <div class="form-group">
        <label class="col-md-2">
            {{ __('category::dashboard.categories.form.start_at') }}
        </label>
        <div class="col-md-9">
            <div class="input-group input-medium date time date-picker"
                 data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                <input type="text" id="offer-form" class="form-control"
                       name="start_at" data-name="start_at" value="{{$model->start_at}}">
                <span class="input-group-btn">
                <button class="btn default" type="button">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>
            </div>
            <div class="help-block"></div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2">
            {{ __('category::dashboard.categories.form.expired_at') }}
        </label>
        <div class="col-md-9">
            <div class="input-group input-medium date time date-picker"
                 data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                <input type="text" id="offer-form" class="form-control"
                       name="expired_at" data-name="expired_at" value="{{$model->expired_at}}">
                <span class="input-group-btn">
                <button class="btn default" type="button">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>
            </div>
            <div class="help-block"></div>
        </div>
    </div>

    {!! field()->file('banner', __('category::dashboard.categories.form.banner'), $model->getFirstMediaUrl('banners')) !!}
    {!! field()->file('mobile_banner', __('category::dashboard.categories.form.mobile_banner'), $model->getFirstMediaUrl('mobile_banners')) !!}
    <input type="hidden" value="100" name="banner_size">
{{--    {!! field()->number('banner_size',__('category::dashboard.categories.form.banner_size'),$model->banner_size,['max'=>100]) !!}--}}
</div>
