<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">
    <head>
        <meta charset="utf-8" />
        <title>Invoice || {{ setting('app_name',locale()) }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ setting('favicon') ? asset(setting('favicon')) : '' }}" />
        <style>
            *{
                margin: unset;
            }
            .clearfix{
                clear: both;
            }
            .container{
                margin-right: auto;
                margin-left: auto;
            }
            .col-xs-3{
                width: 20%;
            }
            .col-xs-6{
                width: 45%;
            }
            .col-xs-5{
                width: 39%;
            }
            .col-xs-7{
                width: 51%;
            }
            .col-xs-3,.col-xs-6,.col-xs-5,.col-xs-7 {
                margin:0;
                position: relative;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
                float: left;
            }


            body {
                font-family: 'Cairo', sans-serif !important;
            }
            .text-center{
                text-align: center;
            }
            .text-left{
                text-align: left;
            }
            .text-right{
                text-align: right;
            }
            .container{
                width: 700px;
                padding: 15px;
                background-color: #FA0D5F;
            }
            .page-container{
                padding: 50px 25px 25px 25px;
                /*background-color: #fdb6cf;*/
                background-color: #FFF;
            }
            .page-container .mainHeader{
                color: #FA0D5F;
                margin:0;
                margin-bottom: 50px;
            }

            .invoice-header p{
                margin: 20px 0;
                font-size: 18px;
            }
            .invoice-header .info{
                padding: 10px 0;
                border-top: 2px solid #FA0D5F;
                border-bottom: 2px solid #FA0D5F;
            }
            .invoice-header .info p{
                line-height: 1.9;
            }
            .text-center{
                text-align: center !important;
            }
            .text-right{
                text-align: right !important;
            }
            .orderId{
                padding: 0 20px;
                margin-top: 30px;
                padding-bottom: 25px;
                border: 2px solid #FA0D5F;
                border-{{locale() == 'ar' ? 'left' : 'right'}}-width: 50px;
                margin-bottom: 40px;
            }
            .orderId h1{
                color: #FA0D5F;
            }
            .orderId h3{
                margin-top: 20px;
            }
            .orderId span{
                font-size: 18px;
            }
            .orderItems{
                border-top: 1px dashed #ddd;
                border-bottom: 1px dashed #ddd;
            }
            .orderItems .info{
                margin: 0;
                background-color: #ddd;
                padding: 25px;
                font-size: 16px;
            }
            .orderItems .header{
                padding: 20px;
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                min-height: 35px;
            }
            .orderItems .item{
                min-height: 80px;
                margin: 0;
                padding: 15px 0;
                background-color: #f6ecef;
                color: #333;
                font-weight: bold;
                font-size: 14px;
                border-bottom: 1px solid #ccc;
            }
            .orderItems .item img{
                width: 80px;
                height: 80px;
            }
            .orderItems .item .itemData{
                padding-top: 5px;
            }
            .orderItems .details{
                margin: 0;
            }
            .orderItems .details .priceLabel,
            .orderItems .details .price{
                padding: 15px;
                font-size: 15px;
                margin: 0;
            }
            .orderItems .details .first{
                border-bottom: 1px solid #ccc;
            }
            .orderItems .details .second{
                font-weight: bold;
            }


            .orderCoupons{
                padding-top: 50px;
            }
            .orderCoupons h2{
                margin-bottom: 20px;
            }
            .orderCoupons .qr,
            .orderCoupons .qrData,
            .orderCoupons .wrapper{
                margin: 0;
            }
            .orderCoupons .qr h4{
                color: #FA0D5F;
                margin-bottom: 20px;
            }
            .orderCoupons .qrData .wrapper,
            .orderCoupons .qrData svg{
                display: inline-block;
                float: {{locale() == 'ar' ? 'right' : 'left'}};
            }
            .orderCoupons .qrData .wrapper{
                margin-left: 20px;
                margin-right: 20px;
            }
            .orderCoupons .qrData .wrapper .code{
                background-color: #FA0D5F;
                color: #FFF;
                padding: 5px 50px;
                text-align: center;
                font-weight: bold;
                margin-bottom: 10px;
                font-size: 16px;
            }

            .orderCoupons .qrData .wrapper span{
                font-size: 15px;
            }
            @if(locale() == 'ar')
            .col-xs-3,
            .col-xs-6{
                float: right;
            }
            @endif
            .payment{
                padding: 20px 0;
                border-top: 2px solid #FA0D5F;
                border-bottom: 2px solid #FA0D5F;
                font-size: 15px;
            }
            .payment h3{
                color: #FA0D5F;
                margin-bottom: 25px;
            }
            .payment p{
                margin-bottom: 5px;
            }
            .payment .row .col-xs-6{
                margin-bottom: 10px;
                padding: 0;
            }
            .footer{
                font-weight: bold;
                font-size: 18px;
                margin-top: 25px;
            }
            .barcode *{
                display: block;
                width: auto;
                margin: 0.5px;
                float: {{locale() == 'ar' ? 'right' : 'left'}};
            }
            .float-left{
                float: left;
            }
            .float-right{
                float: right;
            }
        </style>

        {{--        Offer Details --}}
        <style>
            .bb-1 {
                border-bottom: 1px solid #f1f1f1;
            }
            .pb-3, .py-3 {
                padding-bottom: 1rem!important;
            }
            .pt-3, .py-3 {
                padding-top: 1rem!important;
            }
            .item-feature-info .h4 {
                font-size: 22px;
                margin-bottom: 15px;
            }
            .list-unstyled {
                padding-left: 0;
                list-style: disc;
            }
            ul, li {
                margin: 0;
                padding: 0;
            }
            dl, ol, ul {
                margin-top: 0;
                margin-bottom: 1rem;
            }
            .feature-list li {
                margin-bottom: 5px;
                margin-right: 20px;
                margin-left: 20px;
            }
            ul, li {
                margin: 0;
                padding: 0;
            }
            .item-feature-info .feature-list .feature-item i {
                font-size: 1.25em;
                margin-right: 10px;
            }
            .feature-list p {
                font-size: 16px;
            }

            .mb-0, .my-0 {
                margin-bottom: 0!important;
            }

        </style>
    </head>
    @php $order = (object) $order ; @endphp
    <body>
        <div class="container" dir="{{is_rtl()}}">
            <div class="page-container text-center">
                <div class="invoice-header">
                    <h1 class="mainHeader">
                        <img src="{{ url(setting('logo') ?? '') }}" alt="Couponat Logo">
                    </h1>
                    <div class="text-{{locale() == 'ar' ? 'right' : 'left'}}">
                        <h3>{{__('order::dashboard.orders.emails.greeting')}} {{$order->user->name}}</h3>
                        <p>{{__('order::dashboard.orders.emails.thanks')}}</p>
                        <div class="info">
                            <p> {{__('order::dashboard.orders.emails.note',[
                                    'email' => setting('contact_us','email'),
                                    'phone' => setting('contact_us','call_number')
                                ])}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="order-info">
                    <div class="orderId text-{{locale() == 'ar' ? 'right' : 'left'}}">
                        <h3>{{__('order::dashboard.orders.emails.orderNo')}}</h3>
                        <h1>{{$order->id}}</h1>
                        <div>
                            <span>{{__('order::dashboard.orders.emails.orderDate')}}</span>
                           <span dir="{{is_rtl()}}">  {{date('d M, Y H:i A',strtotime($order->created_at))}}</span>
                        </div>
                    </div>
                    <div class="orderItems" dir="{{is_rtl()}}">
                        <div class="row header">
                            <div class="col-md-3">{{__('order::dashboard.orders.emails.image')}}</div>
                            <div class="col-md-3">{{__('order::dashboard.orders.emails.name')}}</div>
                            <div class="col-md-3">{{__('order::dashboard.orders.emails.quantity')}}</div>
                            <div class="col-md-3">{{__('order::dashboard.orders.emails.subtotal')}}</div>
                            <div class="clearfix"></div>
                        </div>
                        @foreach($order->orderItems()->groupBy('offer_id')->get() as $item)
                            @php $qty = $order->orderItems()->where('offer_id',$item->offer_id)->count(); @endphp
                        <div class="row item">
                            <div class="col-xs-3"><img src="{{$item->offer->main_image}}" alt=""></div>
                            <div class="col-xs-3 itemData">{{$item->offer->title}}</div>
                            <div class="col-xs-3 itemData">{{$qty}}</div>
                            <div class="col-xs-3 itemData">{{number_format($qty * $item->total,3)}} {{__('apps::frontend.kd')}}</div>
                            <div class="clearfix"></div>
                        </div>
                        @endforeach
                        <div class="row details">
                            <div class="col-xs-3 priceLabel first">{{__('order::dashboard.orders.emails.subtotal')}}</div>
                            <div class="col-xs-3 price first">{{number_format($order->subtotal,3)}} {{__('apps::frontend.kd')}}</div>
                            <div class="clearfix"></div>
                        </div>
                        @if(floatval($order->discount) > 0)
                        <div class="row details">
                            <div class="col-xs-3 priceLabel first">{{__('order::dashboard.orders.emails.discount')}}</div>
                            <div class="col-xs-3 price first">{{number_format($order->discount,3)}} {{__('apps::frontend.kd')}}</div>
                            <div class="clearfix"></div>
                        </div>
                        @endif
                        <div class="row details">
                            <div class="col-xs-3 priceLabel second">{{__('order::dashboard.orders.emails.total')}}</div>
                            <div class="col-xs-3 price second">{{number_format($order->total,3)}} {{__('apps::frontend.kd')}}</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="orderCoupons text-{{locale() == 'ar' ? 'right' : 'left'}}">
                        <h2>{{__('order::dashboard.orders.emails.your_coupons')}}</h2>
                        @foreach($order->orderItems as $item)
                            <div class="row qr" style="border-bottom: 1px dashed #ddd;padding-bottom:20px">
                                <h4>{{$item->offer->title}}</h4>
                                <div class="qrData row">
                                    <img class="float-{{locale() == 'ar' ? 'right' : 'left'}}" src="{{asset('/uploads/qr/'.$item->code.'.png')}}" alt="qrImage{{$item->code}}">
                                    <div class="wrapper row float-{{locale() == 'ar' ? 'right' : 'left'}}">
                                        <p class="code">{{$item->code}}</p>
                                        <div class="barcode">
                                            {!! DNS1D::getBarcodeHTML($item->id , 'C39E+') !!}
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="expired float-{{locale() == 'ar' ? 'right' : 'left'}}">
                                            <span>{{__('order::dashboard.orders.emails.expired_at')}}</span>
                                            <b>{{date('Y/m/d',strtotime($item->expired_date))}}</b>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="item-feature-info bb-1 py-3">
                                <h3 class="h4">
                                    {{__('apps::frontend.details')}}:
                                </h3>
                                <ul class="list-unstyled feature-list">
                                    @foreach(explode("\r\n",$item->offer->details) as $detail)
                                        <li class="feature-item">
                                            <p class="mb-0">{{$detail}}</p>
                                        </li>
                                    @endforeach
                                    <li class="feature-item">
                                        <p class="mb-0">{{__('offer::frontend.offers.valid', ['from'=> date('d/m/Y',strtotime($item->offer->user_valid_from??$item->offer->start_at)) , 'to'=> date('d/m/Y',strtotime($item->offer->user_valid_until))])}}</p>
                                    </li>
                                    <li class="feature-item">
                                        <p class="mb-0">
                                            {{__('apps::frontend.location_info')}}:
                                            <a href="https://maps.google.com/?q={{$item->offer->lat}},{{$item->offer->lng}}" target="_blank">{{__('apps::frontend.view_location')}}</a>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <div class="payment text-{{locale() == 'ar' ? 'right' : 'left'}}">
                        <div class="row">
                            <div class="col-xs-7">
                                <h3>{{__('order::dashboard.orders.emails.payment_type')}}</h3>
                                <div class="row">
                                    <div class="col-xs-6">Payment ID</div>
                                    <div class="col-xs-6">{{$order->transactions->payment_id}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">Transaction ID</div>
                                    <div class="col-xs-6">{{$order->transactions->tran_id}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">Track ID</div>
                                    <div class="col-xs-6" style="word-break: break-all">{{$order->transactions->track_id}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">Authorization ID</div>
                                    <div class="col-xs-6">{{$order->transactions->auth}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">Post Date</div>
                                    <div class="col-xs-6">{{$order->transactions->post_date}}</div>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <h3>{{__('order::dashboard.orders.emails.payment_info')}}</h3>
                                <p>{{$order->user->name}}</p>
                                <p>{{$order->user->email}}</p>
                                <p>{{$order->user->getPhone()}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <p class="footer text-center">© {{date('Y')}} couponat.com</p>
            </div>
        </div>
        <!--[if lt IE 9]>
        <script src="{{asset('/admin/assets/global/plugins/respond.min.js')}}"></script>
        <script src="{{asset('/admin/assets/global/plugins/excanvas.min.js')}}"></script>
        <script src="{{asset('/admin/assets/global/plugins/ie8.fix.min.js')}}"></script>
        <![endif]-->
        <script src="{{asset('/admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    </body>
</html>
