@extends('apps::Frontend.layouts.app')
@section('title', __('order::frontend.show.Checkout'))

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="order-done text-center">
                <img class="img-fluid" src="{{asset('frontend/assets/images/icons/reserved.png')}}" alt="" />
                <h1>{{__("apps::frontend.thank_you")}}</h1>
                <a href="{{route('frontend.categories.index')}}" class="btn  btn-primary  mt-20 rounded-pill w-100">{{__("apps::frontend.other_deals")}}</a>

            </div>
        </div>
    </div>
@endsection
