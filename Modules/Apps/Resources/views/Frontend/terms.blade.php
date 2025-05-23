@extends('apps::Frontend.layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="page-head align-items-center text-center d-flex">
            <div class="container">
                <ul>
                    <li><a href="{{URL::to('/')}}"> {{__("apps::frontend.home")}} </a></li>/
                    <li class="active">{{$page->title}}</li>
                </ul>
            </div>
        </section>




        <section class="item-details">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="item-details bb-1 py-3">
                            <div class="discription-box">
                                <h2 class="h3">
                                    {{$page->title}}
                                </h2>
                                <p>{!! $page->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>



@endsection
