@extends('apps::Frontend.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="inner-page">
            <div class="container">
                <div class='row'>
                    <div class="col-md-8  m-auto">
                        <div class="note-box my-4">
                            <div class="media account">
                                <div class="media-body">
                                    <p class="mb-0">
                                        {{__("apps::frontend.change_password")}} <a href="{{route('frontend.profile.index')}}">{{__("apps::frontend.go_to_profile")}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="{{route('frontend.profile.post_change_pass')}}">
                            @csrf
                            <div class="row filter-option">
{{--                                <div class="col-12">--}}
{{--                                    <div class="form-label-group">--}}
{{--                                        <label>{{__("apps::frontend.current_password")}} </label>--}}
{{--                                        <input type="password" name="current" class="form-control rounded-pill" placeholder="{{__("apps::frontend.current_password")}}" required="" autofocus="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <label>{{__("apps::frontend.new_password")}} </label>
                                        <input type="password" name="password" class="form-control rounded-pill" placeholder="{{__("apps::frontend.new_password")}}">
                                    </div>
                                </div>
                                <h2 class="password-note">
                                    <span>*</span> {{__("apps::frontend.password_p")}}
                                </h2>
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <label>{{__("apps::frontend.confirm_password")}} </label>
                                        <input type="password" name="password_confirmation" class="form-control rounded-pill" placeholder="{{__("apps::frontend.confirm_password")}}" required="" autofocus="">
                                    </div>
                                </div>

                                <button type="submit" class="btn  btn-primary rounded-pill btn-w50h50">{{__("apps::frontend.update_password")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
