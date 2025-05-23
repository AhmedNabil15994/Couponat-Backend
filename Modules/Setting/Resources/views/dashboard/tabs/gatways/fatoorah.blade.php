<div class="row">
  <div class="col-md-6 col-md-offset-4">
    <div class="form-group">
      <div class="col-md-9">
        <div class="mt-radio-inline">
          <label class="mt-radio mt-radio-outline">
            {{ __('setting::dashboard.settings.form.payment_gateway.payment_mode.test_mode') }}
            <input onchange="paymentModeSwitcher('my_fatoorah_switch','testModelData_my_fatoorah')" type="radio"
              name="payment_gateway[myfatoorah][payment_mode]" value="test_mode" @if (setting('payment_gateway','myfatoorah.payment_mode') !='live_mode'
              ) checked @endif>
            <span></span>
          </label>
          <label class="mt-radio mt-radio-outline">
            {{ __('setting::dashboard.settings.form.payment_gateway.payment_mode.live_mode') }}
            <input onchange="paymentModeSwitcher('my_fatoorah_switch','liveModelData_my_fatoorah')" type="radio"
              name="payment_gateway[myfatoorah][payment_mode]" value="live_mode" @if (setting('payment_gateway','myfatoorah.payment_mode')=='live_mode' )
              checked @endif>
            <span></span>
          </label>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-7 col-md-offset-2 my_fatoorah_switch" id="testModelData_my_fatoorah"
    style="{{setting('payment_gateway','my_fatoorah.payment_mode') == 'live_mode' ? 'display: none': 'display: block' }}">
    <h3 class="page-title text-center">My Fatoorah Gateway ( Test Mode )</h3>
    {!! field()->text('payment_gateway[myfatoorah][test_mode][API_KEY]', 'API Key',setting('payment_gateway','myfatoorah.test_mode.API_KEY') ?? '') !!}
  </div>
  <div class="col-md-7 col-md-offset-2 my_fatoorah_switch" id="liveModelData_my_fatoorah"
    style="{{setting('payment_gateway','my_fatoorah.payment_mode') == 'live_mode' ? 'display: block': 'display: none' }}">

    <h3 class="page-title text-center">My Fatoorah Gateway ( Live Mode )</h3>

    {!! field()->text('payment_gateway[myfatoorah][live_mode][API_KEY]', 'API Key', setting('payment_gateway','myfatoorah.live_mode.API_KEY') ?? '') !!}

  </div>
  <div class="col-md-7 col-md-offset-2">
    @foreach (config('translatable.locales') as $code)

    {!! field()->text('payment_gateway[myfatoorah][title_'.$code.']',
    __('setting::dashboard.settings.form.payment_gateway.payment_types.payment_title').'-'.$code ,
    setting('payment_gateway','myfatoorah.title_'.$code)) !!}

    @endforeach
    {!! field()->checkBox('payment_gateway[myfatoorah][status]', __('setting::dashboard.settings.form.payment_gateway.payment_types.payment_status') , null , [
    (setting('payment_gateway','myfatoorah.status') == 'on' ? 'checked' : '') => ''
    ]) !!}
  </div>
</div>
