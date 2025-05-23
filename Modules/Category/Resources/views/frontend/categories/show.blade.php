@extends('apps::Frontend.layouts.app')

@section('title',$category->title)
@push('css')
    <style>
        .imgBanner{
            border-radius: 5px;
            height: 400px;
            display: block;
            margin: auto;
            margin-bottom: 50px;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .imgBanner img{
            width: 100%;
            height: 100%;
        }
        .d-hidden{
            display: none !important;
        }
        .relative svg{
            width: 50px;
            height: 25px;
        }
        .loader{
            display: none;
            position: fixed;
            z-index: 999999;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0,0,0,.9);
            background-image: url("{{asset('frontend/tube-spinner.svg')}}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100px;
        }
        body{
            position: relative;
        }
    </style>
@endpush
@section( 'content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="filters-button-group">
                    @foreach($category->children()->active()->get() as $key => $child)
                    <button class="filter" data-filter=".f{{$child->id}}">
                        <span class="d-block">{{$child->title}}</span>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        @foreach($offers as $key=> $keyOffers)
        @if($keyOffers['banner'] != '' && $keyOffers['banner']->id == $key )
            <div class="section-block ads-grid d-desk {{ array_key_first($offers) == $key ? '' : 'd-hidden'  }} f{{$key}} {{$keyOffers['banner']->id}}" >
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-12">
                            <a class="ads-block" href='#'>
                                <div class="img-block">
                                    <img class="img-fluid" src="{{$keyOffers['banner']->getFirstMediaUrl('banners')}}" alt="" />
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-block ads-grid d-mobile {{ array_key_first($offers) == $key ? '' : 'd-hidden'  }} f{{$key}} {{$keyOffers['banner']->id}}">
                <div class="">
                    <div class="">
                        <div class="item">
                            <a class="ads-block" href='#'>
                                <div class="img-block">
                                    <img class="img-fluid" src="{{$keyOffers['banner']->getFirstMediaUrl('mobile_banners')}}" alt="" />
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach

        <div class="grids row">
            @foreach($offers as $key=> $keyOffers)
                @foreach($keyOffers['offers'] as $offer)
                <div class="grid-item col-lg-4 col-md-4 col-sm-6 {{ array_key_first($offers) == $key ? '' : 'd-hidden'  }} f{{$key}} ">
                    @include('offer::frontend.partials.offer-card',['offer'=>$offer])
                </div>
                @endforeach
                <div class="clearfix"></div>
            @endforeach
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(function (){
            $('.filter.active').click()
            $('.filter').on('click',function (){
                // $($(this).data('filter')).siblings('.ads-grid').addClass('hidden')
                $($(this).data('filter')).removeClass('hidden');
                $('.ads-grid').not($(this).data('filter')).addClass('hidden')
            });

            let page = 2;
            function fireAjaxRequest(url){
                $.ajax({
                    url: url,
                    type: 'GET',
                    data:{
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'page': page
                    },
                    success: function(data){
                        $('.row.grids').append(data.offers)
                        if(data.count > 0){
                            $('.loader').show();
                            page++;
                        }
                        setTimeout(function (){
                            $('.loader').hide();
                        },250);
                    },
                    error: function (error){
                    }
                })
            }


            $(window).scroll(function() {
                if($(window).scrollTop() == $(document).height() - $(window).height()) {
                    fireAjaxRequest("{{URL::current()}}");
                }
            });
        });
    </script>
@endpush
