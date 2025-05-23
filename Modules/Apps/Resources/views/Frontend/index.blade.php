@extends('apps::Frontend.layouts.app')
@push('css')
    <style>
        nav[role="navigation"]{
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
@section('content')
    <div class="container-fluid">
        <div class="grids row">
            @foreach($offers as $key => $offer)
                <div class="grid-item col-lg-4 col-md-4 col-sm-6 f1 f11 f21 f31 f41 f51">
                    @include('offer::frontend.partials.offer-card',['offer'=>$offer])
                </div>
            @endforeach
{{--            {!! $offers->render() !!}--}}
        </div>
    </div>
@endsection
@push('js')
    <script>


        $(function(){
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
                    fireAjaxRequest("{{route('frontend.home')}}");
                }
            });
        });
    </script>
@endpush
