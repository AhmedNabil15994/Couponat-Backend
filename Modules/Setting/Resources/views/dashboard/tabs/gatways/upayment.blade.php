<div class="row">
  <div class="col-md-6 col-md-offset-4">
    <div class="form-group">
      <div class="col-md-9">
        <div class="mt-radio-inline">
          <label class="mt-radio mt-radio-outline">
            {{ __('setting::dashboard.settings.form.payment_gateway.payment_mode.test_mode') }}
            <input onchange="paymentModeSwitcher('upay_switch','testModelData_upay')" type="radio" name="payment_gateway[upayment][payment_mode]"
              value="test_mode" @if (setting('payment_gateway','upayment.payment_mode') !='live_mode' ) checked @endif>
            <span></span>
          </label>
          <label onchange="paymentModeSwitcher('upay_switch','liveModelData_upay')" class="mt-radio mt-radio-outline">
            {{ __('setting::dashboard.settings.form.payment_gateway.payment_mode.live_mode') }}
            <input type="radio" name="payment_gateway[upayment][payment_mode]" value="live_mode"
              @if(setting('payment_gateway','upayment.payment_mode')=='live_mode' ) checked @endif>
            <span></span>
          </label>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="row">
  <div class="col-md-7 col-md-offset-2 upay_switch" id="testModelData_upay"
    style="{{setting('payment_gateway','upayment.payment_mode') == 'live_mode' ? 'display: none': 'display: block' }}">

    <h3 class="page-title text-center">UPayment Gateway ( Test Mode )</h3>
    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.merchant_id') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][test_mode][MERCHANT_ID]"
        value="{{setting('payment_gateway','upayment.test_mode.MERCHANT_ID') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.api_key') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][test_mode][API_KEY]"
        value="{{setting('payment_gateway','upayment.test_mode.API_KEY') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.username') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][test_mode][USERNAME]"
        value="{{setting('payment_gateway','upayment.test_mode.USERNAME') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.password') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][test_mode][PASSWORD]"
        value="{{setting('payment_gateway','upayment.test_mode.PASSWORD') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        charges
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][test_mode][charges]"
        value="{{setting('payment_gateway','upayment.test_mode.charges') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        cc_charges
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][test_mode][cc_charges]"
        value="{{setting('payment_gateway','upayment.test_mode.cc_charges') ?? '' }}" />
    </div>
  </div>

  <div class="col-md-7 col-md-offset-2 upay_switch" id="liveModelData_upay"
    style="{{setting('payment_gateway','upayment.payment_mode') == 'live_mode' ? 'display: block': 'display: none' }}">

    <h3 class="page-title text-center">UPayment Gateway ( Live Mode )</h3>
    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.merchant_id') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][live_mode][MERCHANT_ID]"
        value="{{setting('payment_gateway','upayment.live_mode.MERCHANT_ID') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.api_key') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][live_mode][API_KEY]"
        value="{{setting('payment_gateway','upayment.live_mode.API_KEY') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.username') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][live_mode][USERNAME]"
        value="{{setting('payment_gateway','upayment.live_mode.USERNAME') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.password') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][live_mode][PASSWORD]"
        value="{{setting('payment_gateway','upayment.live_mode.PASSWORD') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        {{ __('setting::dashboard.settings.form.payment_gateway.upayment.iban') }}
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][live_mode][IBAN]"
        value="{{setting('payment_gateway','upayment.live_mode.IBAN') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        charges
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][live_mode][charges]"
        value="{{setting('payment_gateway','upayment.live_mode.charges') ?? '' }}" />
    </div>

    <div class="form-group">
      <label>
        cc_charges
      </label>
      <input type="text" class="form-control" name="payment_gateway[upayment][live_mode][cc_charges]"
        value="{{setting('payment_gateway','upayment.live_mode.cc_charges') ?? '' }}" />
    </div>

  </div>
  <div class="col-md-7 col-md-offset-2">

    @foreach (config('translatable.locales') as $code)
    {!! field('payment_search_inputs')->text('payment_gateway[upayment][title_'.$code.']',
    __('setting::dashboard.settings.form.payment_gateway.payment_types.payment_title').'-'.$code ,
    setting('payment_gateway','upayment.title_'.$code)) !!}

    @endforeach
    {!! field()->checkBox('payment_gateway[upayment][status]', __('setting::dashboard.settings.form.payment_gateway.payment_types.payment_status') , null , [
    (setting('payment_gateway','upayment.status') == 'on' ? 'checked' : '') => ''
    ]) !!}
  </div>
</div>
