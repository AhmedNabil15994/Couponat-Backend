@extends('apps::Frontend.layouts.app')
@section('title', __('order::frontend.show.Checkout'))
@section('content')
<div class="inner-page grey-bg">
  <div class="container">
    {!! Form::open([
    'method' => 'POST',
    'id'=>'form',
    ]) !!}
    <div class="order-list checkout-page bg-white">
      <div class="row">
        @guest
        <div class="alert alert-info d-block col-md-12">{{ __('if you have account login from') }} <a href="{{ route('frontend.auth.login') }}">{{ __('here')
            }}</a> </div>

        <div class="col-md-8">
          <div class="row">
            <div class="col-md-6 form-group">
              {!! field('frontend')->text('name',__('name'))!!}
            </div>
            <div class="col-md-6 form-group" dir="ltr">
              {!! field('frontend')->text('mobile',__('mobile') )!!}
            </div>
            <div class="col-md-6 form-group">
              {!! field('frontend')->email('email',__('email') )!!}
            </div>
            <div class="col-md-6 form-group">
              {!! field('frontend')->password('password',__('Password *'),["autocomplete"=>"new-password"])!!}
            </div>
            <div class="col-md-6 form-group">
              {!! field('frontend')->password('password_confirmation',__('Confirm Password *'))!!}
            </div>
          </div>

        </div>

        @endguest
        <div class="{{ auth()->check()?'col-md-12':'col-md-4' }}">
          <div class="checkout-summery row justify-content-end">
            <div class="col-md-12">
              @foreach ($cart as $item)
              @if($item->attributes->type == 'course')
              <div class="order-block course-block d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="img-block">
                    <img class="img-fluid" src="{{url($item->attributes->image) }}">
                  </div>
                  <div class="course-content">
                    <h3><a href="{{route('frontend.courses.show',$item->attributes->product->slug)}}"> {{$item->attributes->product->title}}</a></h3>
                    <a class="tutor-name" href="index.php?page=tutor-profile">By {{ $item->attributes->product->trainer->name }}</a>
                    <span> {{ $item->price }} KWD</span>
                  </div>
                </div>
                <div class="order-status">
                  <a href="{{route('frontend.cart.remove',['course', $item->attributes->item_id])}}" class="remove-item "><i class="ti-close"></i></a>
                </div>
              </div>
              @endif
              @endforeach
              <div class="check-row d-flex align-items-center justify-content-between">
                <h5>{{ __('Subtotal') }}</h5>
                <span> {{ Cart::getTotal() }} <span>KWD</span></span>
              </div>
              <div class="check-row d-flex align-items-center justify-content-between total-price">
                <h5>{{ __('Total') }}</h5>
                <span> {{ Cart::getTotal() }} <span>KWD</span></span>
              </div>
              <span>{{ __('Note: The amount paid is not refundable or exchangeable') }}</span>
              {{-- <div class="cart-payment">
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadioInline8" checked="checked" name="customRadioInline1" class="">
                  <label class="" for="customRadioInline8"> @lang('Pay with')<img class="" src="{{ asset('_frontend/images/payments.svg') }}" alt=""></label>
                </div>
              </div> --}}
              <button type="submit" id="submit" class="btn btn main-custom-btn w-100 my-2" style="width: 100%">{{__('Pay')}}</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    {!! Form::close() !!}
  </div>
</div>



@stop
