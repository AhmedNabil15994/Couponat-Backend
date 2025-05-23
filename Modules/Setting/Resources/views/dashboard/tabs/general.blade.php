<div class="tab-pane active fade in" id="global_setting">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.general') }}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
              {{ __('setting::dashboard.settings.form.locales') }}
            </label>
            <div class="col-md-9">
                <select name="locales[]" id="single" class="form-control select2" multiple="">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (in_array($key,array_keys(config('laravellocalization.supportedLocales'))))
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.rtl_locales') }}
            </label>
            <div class="col-md-9">
                <select name="rtl_locales[]" id="single" class="form-control select2" multiple="">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (in_array($key,config('rtl_locales')))
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.default_language') }}
            </label>
            <div class="col-md-9">
                <select name="default_locale" id="single" class="form-control select2">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (config('default_locale') == $key)
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        @php $reasons = ''; @endphp
        @if(setting('account_deletion'))
            @foreach(json_decode(setting('account_deletion')) as $reason)
                @php $reasons.=$reason->value.','; @endphp
            @endforeach
        @endif

        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.account_deletion.title') }}
            </label>
            <div class="col-md-9">
                <input class='basic' name="account_deletion" value='{{$reasons}}'  autofocus>
            </div>
        </div>

{{--        <div class="form-group">--}}
{{--            <label class="col-md-2">--}}
{{--              {{ __('setting::dashboard.settings.form.currencies') }}--}}
{{--            </label>--}}
{{--            <div class="col-md-9">--}}
{{--                <select name="currencies[]" id="single" class="form-control select2" multiple="">--}}
{{--                    @foreach (CountriesList::currencies() as $code => $currency)--}}
{{--                      <option value=""></option>--}}
{{--                      <option value="{{$code}}"--}}
{{--                      @if (collect(setting('currencies'))->contains($code))--}}
{{--                      selected=""--}}
{{--                      @endif>--}}
{{--                          {{ $currency->name }}--}}
{{--                      </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label class="col-md-2">--}}
{{--                {{ __('setting::dashboard.settings.form.default_currency') }}--}}
{{--            </label>--}}
{{--            <div class="col-md-9">--}}
{{--                <select name="default_currency" id="single" class="form-control select2">--}}
{{--                    @foreach (CountriesList::currencies() as $code => $currency)--}}
{{--                      <option value=""></option>--}}
{{--                      <option value="{{ $code }}"--}}
{{--                      @if (setting('default_currency') == $code)--}}
{{--                      selected--}}
{{--                      @endif>--}}
{{--                        {{ $currency->name }}--}}
{{--                      </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
