@extends('apps::dashboard.layouts.app')
@section('title', __('apps::dashboard.index.title'))
@section('css')
<style>
    .mb-25{
      margin-bottom: 25px !important;
    }
</style>
@endsection
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">
                            {{ __('apps::dashboard.index.title') }}
                        </a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> {{ __('apps::dashboard.index.welcome') }} ,
                <small><b style="color:red">{{ Auth::user()->name }} </b></small>
            </h1>

            <div class="portlet light bordered row">
                <div class="col-xs-12 col-lg-12">
                    <label for="">{{__('apps::dashboard.search_for_offer')}}</label>
                    <form class="form-group mb-25" method="get" action="{{URL::current()}}">
                        <input type="text" class="form-control col-xs-6 col-md-6" style="width: 50%" name="code" value="{{Request::get('code')}}">
                        <div class="col-md-1"></div>
                        <button class="col-md-2 col-xs-6 btn-primary btn" type="submit">{{ __('apps::dashboard.buttons.search') }}</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="col-xs-12 col-lg-12">
                    @if(isset($item))
                        <div class="modal-body ">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 hidden">
                                    <img src="{{ $item->qr }}" width="400px" height="400px">
                                </div>
                                <div class="col-xs-12 col-md-6" style="padding: 30px;">

                                    <p class="text-left" style="margin:10px 20px">{{ $item->offer->discount_desc}}</p>
                                    <p class="text-left" style="margin:10px 20px">{{__('user::dashboard.users.create.form.code')}}: {{$item->code}}</p>
                                    <p class="text-left" style="margin:10px 20px">{{__('user::dashboard.users.create.form.name')}}: {{$item->order->user->name}}</p>
                                    <p class="text-left" style="margin:10px 20px">{{__('apps::frontend.status')}}:
                                        @if($item->expired_date < date('Y-m-d H:i:s'))
                                            <span class="label label-success label-sm" style="padding: 0 25px">{{__('apps::frontend.expired')}}</span>
                                        @else
                                            <span class="label label-danger label-sm" style="padding: 0 25px">{{__('apps::frontend.valid')}}</span>
                                        @endif
                                    </p>
                                    @if($item->expired_date > date('Y-m-d H:i:s'))
                                        <p class="text-left" style="margin:10px 20px">{{__('user::dashboard.users.create.form.expired_at')}}: {{$item->expired_date}}</p>
                                    @endif
                                    <p class="text-left" style="margin:10px 20px">{{__('apps::frontend.redeemed')}}:
                                        @if($item->is_redeemed)
                                            <span class="label label-success label-sm" style="padding: 0 25px">{{__('apps::frontend.yes')}}</span>
                                        @else
                                            <span class="label label-danger label-sm" style="padding: 0 25px">{{__('apps::frontend.no')}}</span>
                                        @endif
                                    </p>
                                    @if($item->is_redeemed)
                                        <p class="text-left" style="margin:10px 20px">{{__('apps::frontend.redeemed_at')}}: {{$item->redeemed_at}}</p>
                                    @endif
                                    @if(auth()->check() &&
                                        ((auth()->user()->can(['seller_access']) && auth()->user()->seller_id == null) ||
                                        auth()->user()->can(['dashboard_access'])) &&
                                        $item->expired_date > date('Y-m-d H:i:s') && !$item->is_redeemed)
                                        <a class="btn btn-primary btn-md" style="display: block;margin: 20px" href="{{route('vendor.offers.redeem',['code'=>$item->code])}}">{{__('user::dashboard.redeem')}}</a>
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
  @include('apps::dashboard.layouts._js')
@endsection
