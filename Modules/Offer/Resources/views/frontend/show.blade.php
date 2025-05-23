@extends('apps::Frontend.layouts.app')

@section('description')
    <meta name="keywords" content="{{$offer->discount_desc}}">
    <meta name="description" content="{{$offer->discount_desc}}"/>
    <meta property="og:image" content="{{asset($offer->main_image)}}"/>
    <meta property="twitter:image:media" content="{{asset($offer->main_image)}}"/>
@stop


@push('css')
    @php
        $styles = [
           'slider.min',
        ];
    @endphp

    <style>
        iframe {
            width: 100%;
        }

        .share-btn a {
            color: inherit;
        }

        /*.banner-section .banner-image .image-wrapper img:not(.img-fuilds){*/
        /*    min-height: unset;*/
        /*    height: 180px;*/
        /*}*/
        /*.banner-section .banner-image.small-banner,*/
        /*.banner-section .container .row .col-sm-6{*/
        /*    height: 180px;*/
        /*}*/
        .px-10 {
            padding-left: 10px;
            padding-right: 10px;
            font-size: 15px;
        }

        @media (max-width: 767px) {
            .owl-carousel .owl-nav.disabled {
                display: block;
            }

            .owl-item .card {
                margin-bottom: 0;
            }

            .owl-item .card .card-body {
                padding-bottom: 0;
            }

            .ads-grid .owl-carousel .owl-nav button.owl-next,
            .ads-grid .owl-carousel .owl-nav button.owl-prev {
                margin: 10px 5px;
                width: 25px;
                height: 25px;
                font-size: 25px;
                background: #ddd;
                border-radius: 50%;
            }
        }

        .mapHref {
            margin-top: 20px;
            margin-bottom: 20px;
            background: #fff;
            padding: 8px 15px;
            border: 1px solid #666;
            border-radius: 10px;
            cursor: pointer;
        }

        .pre {
            white-space: pre-line;
        }

        @if(locale() == 'ar')
            .owl-carousel.owl-rtl {
            direction: rtl !important;
        }

        .owl-stage {
            direction: ltr !important;
        }
        @endif
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <section class="item-details">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($offer->images_arr))
                            <div class="page-wrapper desk-none">
                                <div class="main">
                                    <div class="product-single-container product-single-default">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 product-single-gallery">
                                                <div class="product-slider-container">

                                                    <div
                                                        class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                                        <div class="product-item">
                                                            <img class="product-single-image"
                                                                 src="{{asset($offer->main_image)}}"/>
                                                        </div>
                                                        @foreach($offer->images_arr as $imgKey => $index)
                                                            <div class="product-item">
                                                                <img class="product-single-image"
                                                                     src="{{$index ? asset($index) : ''}}"/>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- End .product-single-carousel -->
                                                    <span class="prod-full-screen">
                                                    <i class="icon-plus"></i>
                                                </span>
                                                </div>

                                                <div class="prod-thumbnail owl-dots">
                                                    <div class="owl-dot">
                                                        <img src="{{asset($offer->main_image)}}" width="110"
                                                             height="110" alt="product-thumbnail"/>
                                                    </div>
                                                    @foreach($offer->images_arr as $imgKey => $index)
                                                        <div class="owl-dot">
                                                            <img src="{{$index ? asset($index) : ''}}" width="110"
                                                                 height="110" alt="product-thumbnail"/>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- End .product-single-gallery -->
                                        </div>
                                        <!-- End .row -->
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="banner-section mob-none">
                            <div class="container p-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="banner-image big-banner single-property">
                                            <div class="image-wrapper">
                                                <a class="image-gallery" href="{{asset($offer->main_image)}}"
                                                   title="11.jpg">
                                                    <img src="{{asset($offer->main_image)}}"
                                                         class="img-fuild img-fuilds" alt="image"/>
                                                </a>
                                            </div>
                                            <button class="btn share-btn {{ $offer->is_favorite ? 'active' : ''}}"
                                                    type="button">
                                                <a href="{{ route('frontend.offers.toggleFavorite',['id'=>$offer->id]) }}"><i
                                                        class="bi bi-heart-fill"></i></a>
                                            </button>
                                            <button class="btn share-btn share-img" type="button" data-toggle="modal"
                                                    data-target="#share-modal">
                                                <img src="{{asset('frontend/assets/images/icons/share.png')}}"/>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-md-block">
                                        <div class="row">
                                            @if(count($offer->images_arr))
                                                @foreach($offer->images_arr as $imgKey => $index)
                                                    <div class="col-md-6 d-nth">
                                                        <div class="banner-image small-banner">
                                                            <div class="image-wrapper">
                                                                <a class="image-gallery"
                                                                   href="{{$index ? asset($index) : ''}}" title="2.jpg">
                                                                    <img src="{{$index ? asset($index) : ''}}"
                                                                         class="img-fuild" alt="image"/>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="gallery" type="button">
                                <i class="bi bi-grid-3x3-gap-fill"></i>
                                {{__('apps::frontend.show_all_photos')}}
                            </button>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="col-md-8">
                        <div class="item-info">
                            <div class="item-title-info bb-1">
                                <h2 class="h3">
                                    {{$offer->title}}
                                </h2>
                                <ul class="list-inline number-list">
                                    <li class="list-inline-item bought-time">
                                        <i class="bi bi-dot"></i>
                                        <span>{{$offer->discount_desc}}</span>
                                    </li>
                                    <li class="list-inline-item bought-time">
                                        @if(locale() == 'ar')
                                            <span
                                                class="offers">%{{$offer->discount_title}} {{__('apps::frontend.off')}}</span>
                                        @else
                                            <span
                                                class="offers">{{$offer->discount_title}}% {{__('apps::frontend.off')}}</span>
                                        @endif
                                    </li>
                                    @if($offer->video)
                                        <li class="list-inline-item video mb-20">
                                            <a href="#video-modal" data-toggle="modal" data-target="#video-modal"><i
                                                    class="ti-control-play"></i> {{__('apps::frontend.watch_video')}}
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="item-details bb-1 py-3">
                            <div class="discription-box pre">
                                <p>{{$offer->description}}</p>
                            </div>
                        </div>
                        <!-- feature -->
                        <div class="item-feature-info bb-1 py-3">
                            <h3 class="h4">
                                {{__('apps::frontend.details')}}:
                            </h3>
                            <ul class="list-unstyled feature-list">
                                @foreach(explode("\r\n",$offer->details) as $item)
                                    <li class="feature-item">
                                        <i class="bi bi-chevron-double-right"></i>
                                        <p class="mb-0">{{$item}}</p>
                                    </li>
                                @endforeach
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">{{__('offer::frontend.offers.valid', ['from'=> date('d/m/Y',strtotime($offer->user_valid_from??$offer->start_at)) , 'to'=> date('d/m/Y',strtotime($offer->user_valid_until))])}}</p>
                                </li>
                            </ul>
                        </div>
                        <!-- map -->
                        <h2 class="h3" style="margin-top: 20px">{{__('apps::frontend.location_info')}}:</h2>
                        {{--                        <a class="mapHref" href="{{$offer->address_link}}" target="_blank" type="button">--}}
                        {{--                            <i class="bi bi-map"></i>--}}
                        {{--                            {{__('apps::frontend.show_address')}}--}}
                        {{--                        </a>--}}
                        <div class="item-lcation py-3">
                            <iframe
                                src="https://maps.google.com/maps?q={{$offer->lat}},{{$offer->lng}}&z=10&output=embed"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>


                    <!-- Stiky colum -->
                    <div class="col-md-4">
                        <div class="sticky-top">
                            <div class="stiky-box p-3">
                                <div class="price-box">
                                    <h3>
                                        @if(locale() == 'ar')
                                            <span> {{number_format($offer->price,3)}} {{__('apps::frontend.kd')}}</span>
                                        @else
                                            <span> {{__('apps::frontend.kd')}} {{number_format($offer->price,3)}} </span>
                                        @endif
                                    </h3>
                                </div>
                                @if($offer->quantity == 0)
                                    <span class="badge badge-danger px-10">{{__('apps::frontend.out_of_stock')}}</span>
                                @else
                                    <form class="check-form" method="get"
                                          action="{{ $offer->price ? route('frontend.cart.add',['id'=>$offer->id,'type'=>'offer']) : '#' }}">
                                        <div class="quantity text-center">
                                            <div
                                                class="buttons-added d-flex align-items-center justify-content-between">
                                                <button class="sign minus"><i class="ti-minus"></i></button>
                                                <div class="qty-text">
                                                    <input type="text" min="1"
                                                           max="{{$offer->quantity <= $offer->user_max_uses ? $offer->quantity : $offer->user_max_uses}}"
                                                           value="1" name="qty" title="Qty" class="input-text qty text"
                                                           size="1">
                                                </div>
                                                <button class="sign plus"><i class="ti-plus"></i></button>
                                            </div>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-gridient btn-block my-2">{{__('apps::frontend.add_to_cart')}}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($related))
                <hr>
                <div class="section-block ads-grid also-like">
                    <div class="container">
                        <h4>{{__('apps::frontend.you_may_like')}} </h4>
                        <div class="product-like owl-carousel">
                            @foreach($related as $oneItem)
                                <div class="item">
                                    @include('offer::frontend.partials.offer-card',['offer'=>$oneItem])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </section>

    </div>

    @include('offer::frontend.partials.slider-modal')
    @include('offer::frontend.partials.share-modal')
    @include('offer::frontend.partials.video-modal')
@endsection



@push('js')
    @php
        $scripts = [
              'bootstrap.bundle.min','plugins.min','slider.min',
          ];
    @endphp
    <script>
        $('.gallery').on('click', function (e) {
            e.preventDefault();
            $('.img-fuild').trigger('click')
        });
        // $(document).on('click', '.quantity .plus, .quantity .minus', function (e) {
        //     var $qty = $(this).closest('.quantity').find('.qty'),
        //         currentVal = parseFloat($qty.val()),
        //         max = parseFloat($qty.attr('max')),
        //         min = parseFloat($qty.attr('min')),
        //         step = $qty.attr('step');
        //     // Format values
        //     if (!currentVal || currentVal === '' || currentVal === 'NaN')
        //         currentVal = 0;
        //     if (max === '' || max === 'NaN')
        //         max = '';
        //     if (min === '' || min === 'NaN')
        //         min = 0;
        //     if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
        //         step = 1;
        //     // Change the value
        //     if ($(this).is('.plus')) {
        //         if (max && (max == currentVal || currentVal > max)) {
        //             $qty.val(max);
        //         } else {
        //             $qty.val(currentVal + parseFloat(step));
        //         }
        //     } else {
        //         if (min && (min == currentVal || currentVal < min)) {
        //             $qty.val(min);
        //         } else if (currentVal > 0) {
        //             $qty.val(currentVal - parseFloat(step));
        //         }
        //     }
        //
        //     // Trigger change event
        //     $qty.trigger('change');
        //     e.preventDefault();
        // });
    </script>
@endpush
