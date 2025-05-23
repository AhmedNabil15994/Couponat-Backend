@extends('apps::vendor.layouts.app')
@section('title', __('order::vendor.orders.show.title'))
@section('css')
    <style media="print">
        @page {
            size  : auto;
            margin: 0;
        }
        @media print {
            a[href]:after {
                content: none !important;
            }
            .contentPrint{
                width: 100%;
            }
            .no-print, .no-print *{
                display: none !important;
            }
        }
    </style>
    <style>
        .mt-50{
            margin-top: 50px;
        }
        html[lang='ar'] .text-right{
            text-align: right !important;
        }
    </style>
@endsection
@section('content')

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('vendor.home')) }}">{{ __('apps::vendor.index.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url(route('vendor.orders.index')) }}">
                        {{__('order::vendor.orders.index.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('order::vendor.orders.show.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <div class="col-md-12">
                <div class="no-print">
                    <div class="col-md-3">
                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                            <li class="active">
                                <a data-toggle="tab" href="#order">
                                    <i class="fa fa-cog"></i> {{__('order::vendor.orders.show.invoice')}}
                                </a>
                                <span class="after"></span>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#update">
                                    <i class="fa fa-cog"></i> {{__('order::vendor.orders.show.update')}}
                                </a>
                                <span class="after"></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 contentPrint">
                    <div class="tab-content">

                        <div class="tab-pane active" id="order">
                            <div class="invoice-content-2 bordered">

                                <div class="col-md-12" style="margin-bottom: 24px;">
                                    <center>
                                        <img src="{{setting('logo') ? asset(setting('logo')) : asset('frontend/assets/images/mlogo-dark.png') }}" class="img-responsive" style="margin-bottom: 25px;width:18%" />
                                        <b>
                                            #{{ $order['id'] }} -
                                            {{ date('Y-m-d / H:i:s' , strtotime($order->created_at)) }} / {{ $order['type'] }}
                                        </b>
                                    </center>
                                    @if ($order['type'] == 'cash')
                                      <center>{{__('order::vendor.orders.show.cash_payment')}}</center>
                                    @else
                                      <center>{{ $order->orderStatus->title }}</center>
                                    @endif
                                </div>

                                @if ($order->user)
                                    <div class="row">
                                        <div class="col-xs-12 table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="invoice-title uppercase text-center">
                                                            {{__('order::vendor.orders.show.username')}}
                                                        </th>
                                                        <th class="invoice-title uppercase text-center">
                                                            {{__('order::vendor.orders.show.email')}}
                                                        </th>
                                                        <th class="invoice-title uppercase text-center">
                                                            {{__('order::vendor.orders.show.mobile')}}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center sbold"> {{ $order->user->name }}</td>
                                                        <td class="text-center sbold"> {{ $order->user->email }}</td>
                                                        <td class="text-center sbold"> {{ $order->user->mobile }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-xs-12 table-responsive">
                                        @php
                                            $prices = 0;
                                            $discount = 0;
                                        @endphp
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="invoice-title uppercase text-center">
                                                        {{__('order::vendor.orders.show.order.item')}}
                                                    </th>
                                                    <th class="invoice-title uppercase text-center">
                                                        {{__('order::vendor.orders.show.order.qty')}}
                                                    </th>
                                                    <th class="invoice-title uppercase text-center">
                                                        {{__('order::vendor.orders.show.order.course_price')}}
                                                    </th>
                                                    <th class="invoice-title uppercase text-center">
                                                        {{__('order::vendor.orders.show.order.off')}}
                                                    </th>
                                                    <th class="invoice-title uppercase text-center hidden-print">
                                                        {{__('user::dashboard.users.datatable.options')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderItems as $item)
                                                    @php
                                                    $prices+= $item->total;
                                                    $discount+= $item->offer->price - $item->total;
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center sbold">
                                                          <a href="{{route('vendor.offers.edit',['offer'=>$item->offer_id])}}" target="_blank">{{ $item->offer->title }}</a>
                                                            @if($item->code)
                                                                @include('user::frontend.profile.components.qrCode-modal',[
                                                                    'qr' => QrCode::size(460)->generate( route('vendor.offers.redeem',['code'=>$item->code]) ),
                                                                    'id' => $item->id,
                                                                    'status'    => 1,
                                                                    'date'      => $item->redeemed_at,
                                                                    'item'      => $item
                                                                ])
                                                            @endif
                                                        </td>
                                                        <td class="text-center sbold">
                                                            {{ $item->qty }}
                                                        </td>
                                                        <td class="text-center sbold">
                                                            {{ number_format($item->offer->price,3) }}
                                                        </td>
                                                        <td class="text-center sbold">
                                                            {{ number_format($item->offer->price - $item->total,3) }}
                                                        </td>
                                                        <td class="text-center hidden-print">
                                                            <button  class="btn btn-primary btn-icon" data-toggle="modal" data-item="{{$item->code}}" data-target="#qrCode{{$item->id}}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="invoice-title uppercase text-center">
                                                        {{__('order::vendor.orders.show.order.subtotal')}}
                                                    </th>
                                                    <th class="invoice-title uppercase text-center">
                                                        {{__('order::vendor.orders.show.order.off')}}
                                                    </th>
                                                    <th class="invoice-title uppercase text-center">
                                                        {{__('order::vendor.orders.show.order.total')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center sbold">
                                                        {{ number_format($prices + $discount,3) }} {{ setting('default_currency') }}
                                                    </td>
                                                    <td class="text-center sbold">
                                                        {{ number_format($discount ,3) }} {{ setting('default_currency') }}
                                                    </td>
                                                    <td class="text-center sbold">
                                                        {{ number_format($order->seller_prices['seller_total'],3) }} {{ setting('default_currency') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane" id="update">
                            <form id="updateForm" role="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{ route('vendor.orders.update',$order['id']) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="col-md-2">
                                        {{__('order::vendor.orders.show.status')}}
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="status_id" id="single" class="form-control select2" data-name="status_id">
                                            <option value=""></option>
                                            @foreach ($statuses as $status)
                                            <option value="{{ $status['id'] }}" {{ $order->order_status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-actions">
                                        @include('apps::vendor.layouts._ajax-msg')
                                        <div class="form-group">
                                            <button type="submit" id="submit" class="btn btn-lg green">
                                                {{__('apps::vendor.buttons.edit')}}
                                            </button>
                                            <a href="{{url(route('vendor.orders.index')) }}" class="btn btn-lg red">
                                                {{__('apps::vendor.buttons.back')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
                        {{__('apps::vendor.buttons.print')}}
                        <i class="fa fa-print"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')

<script>
    $('.24_format').timepicker({
        showMeridian: true,
        format: 'hh:mm',
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '0d'
    });
    let item_code = '{{request()->item_code}}';
    if(item_code != ''){
        $('[data-item="'+item_code+'"]').trigger('click')
    }
</script>

@stop
