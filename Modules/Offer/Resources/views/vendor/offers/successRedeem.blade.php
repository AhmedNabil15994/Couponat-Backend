@extends('apps::vendor.layouts.app')
@section('title', __('apps::vendor.index.title'))
@section('css')
<style>
    .mb-25{
      margin-bottom: 25px !important;
    }
    .portlet.light.bordered{
        border: 1px solid #e7ecf1!important;
    }
    .pd-x-20{
        padding-right: 20px;
        padding-left: 20px;
    }
</style>
@endsection
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('vendor.home')) }}">
                            {{ __('apps::vendor.index.title') }}
                        </a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title ">
                <p class="bg-success text-white-50 padding-tb-20 pd-x-20">
                    {{ __('apps::vendor.index.thank_you') }} , <br>
                    <small><b style="color:red">{{ __('apps::vendor.index.you_redeemed') }} </b></small>
                </p>
            </h1>

            <div class="portlet light bordered row">
                <div class="col-xs-12 col-lg-12">
                    @if(isset($offer))
                        <div class="modal-body ">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 hidden">
                                    <img src="{{ $offer->qr }}" width="400px" height="400px">
                                </div>
                                <div class="col-xs-12 col-md-6" style="padding: 30px;">

                                    <p class="text-left" style="margin:10px 20px">{{ $offer->offer->discount_desc}}</p>
                                    <p class="text-left" style="margin:10px 20px">{{__('user::dashboard.users.create.form.code')}}: {{$offer->code}}</p>
                                    <p class="text-left" style="margin:10px 20px">{{__('user::dashboard.users.create.form.name')}}: {{$offer->order->user->name}}</p>
                                    <p class="text-left" style="margin:10px 20px">{{__('apps::frontend.status')}}:
                                        @if($offer->expired_date < date('Y-m-d H:i:s'))
                                            <span class="label label-danger label-sm" style="padding: 0 25px">{{__('apps::frontend.expired')}}</span>
                                        @else
                                            <span class="label label-success label-sm" style="padding: 0 25px">{{__('apps::frontend.valid')}}</span>
                                        @endif
                                    </p>
                                    @if($offer->expired_date > date('Y-m-d H:i:s'))
                                        <p class="text-left" style="margin:10px 20px">{{__('user::dashboard.users.create.form.expired_at')}}: {{$offer->expired_date}}</p>
                                    @endif
                                    <p class="text-left" style="margin:10px 20px">{{__('apps::frontend.redeemed')}}:
                                        @if($offer->is_redeemed)
                                            <span class="label label-success label-sm" style="padding: 0 25px">{{__('apps::frontend.yes')}}</span>
                                        @else
                                            <span class="label label-danger label-sm" style="padding: 0 25px">{{__('apps::frontend.no')}}</span>
                                        @endif
                                    </p>
                                    @if($offer->is_redeemed)
                                        <p class="text-left" style="margin:10px 20px">{{__('apps::frontend.redeemed_at')}}: {{$offer->redeemed_at}}</p>
                                    @endif
                                    @if(auth()->check() && (auth()->user()->can(['seller_access']))  && !$offer->is_redeemed)
                                        <a class="btn btn-primary btn-md" style="display: block;margin: 20px" href="{{route('vendor.offers.redeem',['code'=>$offer->code])}}">{{__('user::dashboard.redeem')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="clearfix"></div>

            </div>
        </div>
    </div>

@stop
@section('scripts')
  @include('apps::vendor.layouts._js')
@endsection
