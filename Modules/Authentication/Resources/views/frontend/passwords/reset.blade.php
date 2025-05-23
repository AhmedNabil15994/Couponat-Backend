@extends('apps::Frontend.layouts.app')
@section('title', __('authentication::frontend.login.index.title') )
@section('content')
    <div class="container-fluid">
        <section class="page-head align-items-center text-center d-flex">
            <div class="container">
                <ul>
                    <li><a href="{{URL::to('/')}}"> {{__("apps::frontend.home")}} </a></li>/
                    <li class="active">{{ __('authentication::frontend.change_password.index.title') }}</li>
                </ul>
            </div>
        </section>

        <div class="box-form">
            <div class="container">
                <div class="row">
                    <h2 class="h3">
                        <i class="bi bi-person-bounding-box"></i> {{ __('authentication::frontend.change_password.index.title') }}
                    </h2>
                    <div class="col-12">
                        <form method="post" action="{{route('frontend.password.update')}}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="row filter-option">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <label>{{__("apps::frontend.your_email")}}</label>
                                        <input type="email" name="email" readonly value="{{$email}}" class="form-control rounded-pill" placeholder="{{__("apps::frontend.your_email")}}" required="" autofocus="">
                                    </div>
                                </div>
                            </div>
                            <div class="row filter-option">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <label>{{__("apps::frontend.new_password")}}</label>
                                        <input type="password" name="password" class="form-control rounded-pill" placeholder="{{__("apps::frontend.new_password")}}" required="" autofocus="">
                                    </div>
                                </div>
                            </div>
                            <div class="row filter-option">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <label>{{__("apps::frontend.confirm_password")}}</label>
                                        <input type="password" name="password_confirmation" class="form-control rounded-pill" placeholder="{{__("apps::frontend.confirm_password")}}" required="" autofocus="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn  btn-primary rounded-pill btn-w100 mt-20">{{ __('authentication::frontend.change_password.index.title') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
