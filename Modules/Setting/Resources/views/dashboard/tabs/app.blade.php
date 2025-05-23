<div class="tab-pane fade" id="app">
  <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.app') }}</h3>
  <div class="col-md-10">
    @foreach (setting('locales')??[] as $key)
    <div class="form-group">
      <label class="col-md-2">
        {{ __('setting::dashboard.settings.form.app_name') }} - {{ $key }}
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control" name="app_name[{{$key}}]" value="{{ setting('app_name',$key) }}" />
      </div>
    </div>
          <div class="form-group">
              <label class="col-md-2">
                  {{ __('setting::dashboard.settings.form.office_address') }} - {{ $key }}
              </label>
              <div class="col-md-9">
                  <input type="text" class="form-control" name="office_address[{{$key}}]" value="{{ setting('office_address',$key) }}" />
              </div>
          </div>
    @endforeach
    <div class="form-group">
      <label class="col-md-2">
        {{ __('setting::dashboard.settings.form.contacts_email') }}
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control" name="contact_us[email]" value="{{ setting('contact_us','email') }}" />
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2">
        {{ __('setting::dashboard.settings.form.contacts_whatsapp') }}
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control" name="contact_us[whatsapp]" value="{{ setting('contact_us','whatsapp') }}" />
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2">
        {{ __('setting::dashboard.settings.form.contacts_call_number') }}
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control" name="contact_us[call_number]" value="{{ setting('contact_us','call_number') }}" />
      </div>
    </div>
  </div>
</div>
