@extends('apps::Frontend.layouts.app')
@section('title', __('authentication::frontend.login.index.title') )
@section('content')
<div class="container-fluid">
    <section class="page-head align-items-center text-center d-flex">
        <div class="container">
            <ul>
                <li><a href="{{URL::to('/')}}"> {{__("apps::frontend.home")}} </a></li>/
                <li class="active">{{__("apps::frontend.sign_in")}}</li>
            </ul>
        </div>
    </section>

    <div class="box-form">
        <div class="container">
            <div class="row">
                <h2 class="h3">
                    <i class="bi bi-person-bounding-box"></i> {{__("apps::frontend.sign_in")}}
                </h2>
                <div class="col-12">
                    <form method="post" class="login" action="{{route('frontend.auth.login.post')}}">
                        @csrf
                        <div class="row filter-option">
                            <div class="col-12">
                                <div class="form-label-group">
                                    <label>{{__("apps::frontend.your_email")}}</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control rounded-pill" placeholder="{{__("apps::frontend.your_email")}}" required="" autofocus="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group">
                                    <label>{{__("apps::frontend.password")}}</label>
                                    <input type="password" name="password" class="form-control rounded-pill" placeholder="{{__("apps::frontend.password")}}" required="" autofocus="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="log-links">
                                    <a href="{{route('frontend.auth.password.request')}}" class="text-dark d-table u py-1"><i class="bi bi-key-fill"></i> {{__("apps::frontend.forget")}}</a>
                                    <a href="{{route('frontend.auth.register')}}" class="text-dark d-table u py-1"><i class="bi bi-person-plus-fill"></i> {{__("apps::frontend.no_account")}}</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn  btn-primary rounded-pill btn-w100 mt-20">{{__("apps::frontend.sign_in")}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('authentication::frontend.verification_modal')
@stop
