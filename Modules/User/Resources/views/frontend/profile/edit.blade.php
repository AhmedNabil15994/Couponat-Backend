@extends('apps::Frontend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="inner-page">
            <div class="container">
                <div class='row'>

                    <div class="col-md-8 m-auto">
                        <div class="item-info trip">
                            <div class="item-title-info bb-1">
                                <div class="note-box my-4">
                                    <div class="media account">
                                        <div class="media-body">
                                            <p class="mb-0">
                                                {{__("apps::frontend.my_details")}} <a href="{{route('frontend.profile.index')}}">{{__("apps::frontend.go_to_profile")}}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="{{route('frontend.profile.update')}}">
                                    @csrf
                                    <div class="card-info">
                                        <ul class="list-inline number-list">
                                            <li class="list-inline-item">
                                                <span class="reserve-title">{{__("apps::frontend.legal_name")}}</span>
                                                <span class="reserve-date">{{auth()->user()->name}}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" id="cbox">{{__("apps::frontend.edit")}}</a>
                                            </li>
                                        </ul>
                                        <div class="filter-option" id="cbox_info">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-label-group">
                                                            <label>{{__("apps::frontend.full_name")}}</label>
                                                            <input type="text" class="form-control rounded-pill" name="name" value="{{auth()->user()->name}}" placeholder="{{__("apps::frontend.full_name")}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn  btn-primary rounded-pill">{{__("apps::frontend.save")}}</button>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <ul class="list-inline number-list">
                                            <li class="list-inline-item">
                                                <span class="reserve-title">{{__("apps::frontend.email-address")}}</span>
                                                <span class="reserve-date">{{auth()->user()->email}}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" id="cbox2">{{__("apps::frontend.edit")}}</a>
                                            </li>
                                        </ul>
                                        <div class="row filter-option" id="cbox_info2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-label-group">
                                                            <label>{{__("apps::frontend.your_email")}} </label>
                                                            <input type="email" class="form-control rounded-pill" name="email" value="{{auth()->user()->email}}" placeholder="{{__("apps::frontend.your_email")}} " required="" autofocus="">
                                                        </div>
                                                    </div>
    {{--                                                <div class="col-12">--}}
    {{--                                                    <div class="form-label-group">--}}
    {{--                                                        <label>Confirm Your Email </label>--}}
    {{--                                                        <input type="email" class="form-control rounded-pill" placeholder="Confirm Your Email" required="" autofocus="">--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
                                                </div>
                                                <button type="submit" class="btn  btn-primary rounded-pill">{{__("apps::frontend.save")}}</button>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <ul class="list-inline number-list">
                                            <li class="list-inline-item">
                                                <span class="reserve-title">{{__("apps::frontend.mobile")}}</span>
                                                <span class="reserve-date">{{auth()->user()->mobile}}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" id="cbox">{{__("apps::frontend.edit")}}</a>
                                            </li>
                                        </ul>
                                        <div class="filter-option" id="cbox_info">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-label-group">
                                                            <label>{{__("apps::frontend.mobile")}}</label>
                                                            <input type="text" class="form-control rounded-pill" name="mobile" value="{{auth()->user()->mobile}}" placeholder="{{__("apps::frontend.mobile")}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn  btn-primary rounded-pill">{{__("apps::frontend.save")}}</button>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <ul class="list-inline number-list">
                                            <li class="list-inline-item">
                                                <span class="reserve-title">{{__("apps::frontend.birthday")}}</span>
                                                <span class="reserve-date">{{auth()->user()->birthday ? date('d/m/Y',strtotime(auth()->user()->birthday)) : 'DD / MM / YY'}} </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" id="cbox3">{{__("apps::frontend.edit")}}</a>
                                            </li>
                                        </ul>
                                        <div class="row filter-option" id="cbox_info3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-label-group">
                                                            <label>{{__("apps::frontend.birthday_optional")}}</label>
                                                            <input type="date" name="birthday" value="{{auth()->user()->birthday}}" class="form-control rounded-pill">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn  btn-primary rounded-pill">{{__("apps::frontend.save")}}</button>
                                        </div>
                                    </div>
                                    <div class="card-info">
                                        <ul class="list-inline number-list">
                                            <li class="list-inline-item">
                                                <span class="reserve-title">{{__("apps::frontend.gender")}}</span>
                                                <span class="reserve-date">{{auth()->user()->gender == 1 ? __("apps::frontend.male") : __("apps::frontend.female") }}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" id="cbox4">{{__("apps::frontend.edit")}}</a>
                                            </li>
                                        </ul>
                                        <div class="row filter-option" id="cbox_info4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-label-group">
                                                            <label for="exampleFormControlSelect1">{{__("apps::frontend.gender_p2")}}</label>
                                                            <select class="form-control rounded-pill" name="gender" id="exampleFormControlSelect1">
                                                                <option value="1" {{auth()->user()->gender == 1 ? 'selected' : ''}}>{{__("apps::frontend.male")}}</option>
                                                                <option value="2" {{auth()->user()->gender == 2 ? 'selected' : ''}}>{{__("apps::frontend.female")}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn  btn-primary rounded-pill">{{__("apps::frontend.save")}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
