@extends('apps::frontend.layouts.app')
@section('title', __('authentication::frontend.login.index.title') )
@section('content')
<section class="inner-banner">
  <div class="container">
    <ul class="list-unstyled thm-breadcrumb">
      <li><a href="{{ route('frontend.home') }}">{{ __('Home') }} </a></li>
      <li class="active"><a href="#">@lang("Login")</a></li>
    </ul>
  </div>
</section>

<section class="contact-one bg-color-dark">
    <div class="container justify-content-center">

        <h2 class="contact-one__title text-center">@lang("Login")</h2>
        {!! Form::open([
            'url'=> route('frontend.auth.verification-otp.post'),
            'method'=>'POST',
            'class'=>'login-form contact-one__form',
            'files' => true,
            'novalidate' => ''
            ])!!}

            @include('apps::frontend.layouts._alerts')

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="row low-gutters ">
                        {!! field('auth')->email('otp',__('Otp'))!!}
                        <input type="hidden" name="mobile" value="{{$mobile}}"/>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">@lang("Remember")
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-center">
                                <button type="submit" class="contact-one__btn thm-btn">@lang("Login")</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

    </div>
</section>

@stop
