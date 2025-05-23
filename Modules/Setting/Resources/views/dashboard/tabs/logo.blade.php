<div class="tab-pane fade" id="logo">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.logo') }}</h3>
    <div class="col-md-10">
        {!! field()->file('images[logo]' , __('setting::dashboard.settings.form.logo') , setting('logo') ? url(setting('logo')) : null) !!}
        {!! field()->file('images[footer_logo]' , __('setting::dashboard.settings.form.footer_logo') , setting('footer_logo') ? url(setting('footer_logo')) : null) !!}
        {!! field()->file('images[favicon]' , __('setting::dashboard.settings.form.favicon') , setting('favicon') ? url(setting('favicon')) : null) !!}
        {!! field()->file('images[splash_image]' , __('setting::dashboard.settings.form.splash_image') , setting('splash_image') ? url(setting('splash_image')) : null) !!}
    </div>
</div>
