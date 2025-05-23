@extends('apps::Frontend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="inner-page">
            <div class="container">
                <div class='row'>
                    <div class="col-md-12">
                        <div class="note-box my-4">
                            <div class="media account">
                                <div class="media-body">
                                    <p class="mb-0">
                                        {{__("apps::frontend.my_coupons")}} <a href="{{route('frontend.profile.index')}}">{{__("apps::frontend.go_to_profile")}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <section class="filter-section">
                            <div class="container">
                                <div class="grid row">
                                    @foreach($orders as $order)
                                    <div class="grid-item col-lg-4 col-md-4 col-sm-12">
                                        <div class="stiky-box p-3">
                                            <div class="price-box bb-1 co-order">
                                                <h3>
                                                    <i class="ti-shopping-cart"></i><span>{{__('apps::frontend.order_no')}} #{{$order->id}}</span>
                                                </h3>
                                            </div>
                                            <div class="charge-fees bb-1  py-3">
                                                @foreach($order->orderItems as $item)
                                                <div class="d-flex row  py-1">
                                                    <div class="col-6">
                                                        <span><a target="_blank" href="{{route('frontend.offers.show',[$item->offer_id])}}">{{$item->offer->title}}</a></span>
                                                    </div>
                                                    <div class="col-2">
                                                        <span class="co-grey">{{$item->qty}}x</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <span class="co-main">{{__('apps::frontend.kd')}} <b>{{$item->total}}</b> </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex  justify-content-between  font-weight-bold py-3">
                                                    <span>{{__('apps::frontend.expiry_date')}} : {{date('d/m/Y',strtotime($item->expired_date))}}</span>
                                                    @if($item->expired_date > date('Y-m-d'))
                                                        <span class="co-main-green">{{__('apps::frontend.active')}}</span>
                                                    @else
                                                        <span class="co-main">{{__('apps::frontend.expired')}}</span>
                                                    @endif
                                                    @if($item->code)
                                                    @include('user::frontend.profile.components.qrCode-modal',[
                                                        'qr' => QrCode::size(460)->generate( route('vendor.home').'?code='.$item->code ),
                                                        'id' => $item->id,
                                                        'status'    => $item->is_redeemed,
                                                        'date'      => $item->redeemed_at,
                                                        'item'      => $item
                                                    ])
                                                    @endif
                                                    <a class="copun-more" href="#" data-toggle="modal" data-target="#qrCode{{$item->id}}">{{__('apps::frontend.more')}} <i class="bi bi-arrow-right-short"></i></a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



@push('js')
@endpush
