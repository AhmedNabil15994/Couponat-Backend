@extends('apps::Frontend.layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="page-head align-items-center text-center d-flex">
            <div class="container">
                <ul>
                    <li><a href="{{URL::to('/')}}"> {{__("apps::frontend.home")}} </a></li>/
                    <li class="active">{{__("apps::frontend.faq")}}</li>
                </ul>
            </div>
        </section>

        <!--============== Faqs Start ==============-->
        <div class="full-row">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        @foreach($data as $faq)
                        <div class="simple-collaps px-4 py-3 bg-white border rounded mb-3">
                            <span class="accordion text-info d-block">{{$faq->title}}</span>
                            <div class="panel" style="">
                                {!! $faq->description !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!--============== Faqs End ==============-->
    </div>

@endsection
@push('js')
    <script>
        $(function(){
            $('.simple-collaps').on('click',function(){
                if($(this).children('.panel').hasClass('active')){
                    $(this).children('.panel').css('maxHeight','0');
                    $(this).children('.panel').removeClass('active')
                }else{
                    $(this).children('.panel').css('maxHeight','200px');
                    $(this).children('.panel').addClass('active')
                }
            })
        });
    </script>
@endpush
