@extends('apps::Frontend.layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="item-details">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="note-box my-4">
                            <div class="media account">
                                <div class="media-body">
                                    <p class="mb-0">
                                    <span class="font-weight-bold">
                                        {{__("apps::frontend.profile")}}
                                    </span>
                                        {{__("apps::frontend.hello")}} {{ucwords(auth()->user()->name)}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- title -->
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{route('frontend.profile.edit')}}" class="box-account">
                                    <img src="{{asset('frontend/assets/images/icons/personal-information.png')}}" />
                                    <h2> {{__("apps::frontend.my_details")}}</h2>
                                    <p>{{__("apps::frontend.my_details_p")}}</p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('frontend.profile.change_pass')}}" class="box-account">
                                    <img src="{{asset('frontend/assets/images/icons/padlock.png')}}" />
                                    <h2>{{__("apps::frontend.change_password")}}</h2>
                                    <p>{{__("apps::frontend.change_password_p")}}</p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('frontend.profile.favourites.index')}}" class="box-account">
                                    <img src="{{asset('frontend/assets/images/icons/wishlist.png')}}" />
                                    <h2>{{__("apps::frontend.favorite")}}</h2>
                                    <p>{{__("apps::frontend.favorite_p")}}</p>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('frontend.profile.my-orders')}}" class="box-account">
                                    <img src="{{asset('frontend/assets/images/icons/voucher.png')}}" />
                                    <h2>{{__("apps::frontend.my_coupons")}}</h2>
                                    <p> {{__("apps::frontend.my_coupons_p")}}</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
