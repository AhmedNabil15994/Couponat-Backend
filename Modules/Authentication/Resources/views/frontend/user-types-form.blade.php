@inject('levels', 'Modules\Course\Entities\Level')
<div class="form-group">
  <label class="d-inline-block"> {{ __('authentication::frontend.register.index.user_types.title') }}</label>
  <div class="custom-control custom-radio custom-control-inline for-children">
    <input type="radio"
      class=""
      id="parent"
      name="user_type"
      value="parent"
      {{
      old('user_type')=='parent'
      ?'checked':''
      }}>
    <label class=""
      for="parent">{{ __('authentication::frontend.register.index.user_types.parent') }}</label>
  </div>
  <div class="custom-control custom-radio custom-control-inline for-you">
    <input type="radio"
      class=""
      id="student"
      name="user_type"
      value="student"
      {{
      old('user_type')=='student'
      ?'checked':''
      }}>
    <label class=""
      for="student">{{ __('authentication::frontend.register.index.user_types.student') }}</label>
  </div>
</div>
<div id="for-children"
  @class(["active"=>old('user_type')=='parent'])>
  <div class="login-head">
    <h3>{{ __('authentication::frontend.register.index.user_types.student_information') }} </h3>
  </div>
  <div class='new-member'>

    {!!
    field('frontend')->text('children[name]',__('authentication::frontend.register.index.username'))!!}
    <input class="form-control date"
      data-dd-large-only="true"
      type="text"
      placeholder="  *" />

    <div>
      {!! field('frontend')->select('children[level_id]',__('authentication::frontend.register.index.level')
      ,
      $levels->pluck('title','id'), null,['class'=>'nice-select form-control']) !!}
    </div>


    <select class="nice-select form-control"
      name="children[lang]">
      <option value="{{ locale() }}">
        {{ __('authentication::frontend.register.index.user_types.preferred_language') }}
      </option>
      @foreach (config('laravellocalization.supportedLocales') as $key => $language)
      <option value="{{ $key }}">
        {{ $language['native'] }}
      </option>
      @endforeach
    </select>
    <div class="form-group">
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio"
          class=""
          id="children-male"
          name="children[gender]"
          value="male"
          checked="checked">
        <label class=""
          for="children-male">{{ __('authentication::frontend.register.index.male') }}</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio"
          class=""
          id="children-female"
          name="children[gender]"
          value="customEx">
        <label class=""
          for="customRadio4">{{ __('authentication::frontend.register.index.female') }}</label>
      </div>
    </div>
  </div>
</div>

<div id="for-you"
  @class(["active"=>old('user_type')=='student'])>
  <div class='new-member'>
    <div>
      {!! field('frontend')->select('extra[level_id]',__('authentication::frontend.register.index.level')
      ,
      $levels->pluck('title','id'), null,['class'=>'nice-select form-control']) !!}
    </div>
    <select class="nice-select form-control"
      name="extra[lang]">
      <option value="{{ locale() }}"> {{ __('authentication::frontend.register.index.user_types.preferred_language') }}</option>
      @foreach (config('laravellocalization.supportedLocales') as $key => $language)
      <option value="{{ $key }}">
        {{ $language['native'] }}
      </option>
      @endforeach
    </select>
  </div>
</div>
