@extends('apps::Frontend.layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="page-head align-items-center text-center d-flex">
            <div class="container">
                <ul>
                    <li><a href="{{URL::to('/')}}"> {{__("apps::frontend.home")}} </a></li>/
                    <li class="active">{{__("apps::frontend.contact_us")}}</li>
                </ul>
            </div>
        </section>

        <!--============== Contact form Start ==============-->
        <div class="full-row pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 order-md-2">
                        <h4 class="down-line mb-5">{{__("apps::frontend.get_in")}}</h4>
{{--                        <p>Nullam vel enim risus. Integer rhoncus hendrerit sem egestas porttitor.</p>--}}
                        <div class="mb-3">
                            <ul>
                                <li class="mb-3">
                                    <h6 class="mb-0">{{__("apps::frontend.office_address")}} :</h6> {{setting('office_address')[locale()] ?? ''}}
                                </li>
                                <li class="mb-3">
                                    <h6>{{__("apps::frontend.contact_number")}} :</h6> {{setting('contact_us')['call_number'] ?? ''}}
                                </li>
                                <li class="mb-3">
                                    <h6>{{__("apps::frontend.email_address")}} :</h6> {{setting('contact_us')['email'] ?? ''}}
                                </li>
                            </ul>
                        </div>
                        <h5 class="mb-2">{{__("apps::frontend.career_info")}}</h5>
                        <p>{{__("apps::frontend.career_info_p")}}:<br> <a href="mailto:{{setting('contact_us')['email'] ?? ''}}">{{setting('contact_us')['email'] ?? ''}}</a></p>
                    </div>
                    <div class="col-md-7 order-md-1">
                        <h4 class="down-line mb-5">{{__("apps::frontend.send_message")}}</h4>
                        <div class="form-simple mb-5">
                            <form id="contact-form" action="{{URL::current()}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-20">
                                        <label class="mb-2">{{__("apps::frontend.full_name")}}:</label>
                                        <input type="text" class="form-control bg-gray" name="name" required="">
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label class="mb-2">{{__("apps::frontend.your_email")}}:</label>
                                        <input type="email" class="form-control bg-gray" name="email" required="">
                                    </div>
                                    <div class="col-md-12 mb-20">
                                        <label class="mb-2">{{__("apps::frontend.mobile")}}:</label>
                                        <input type="text" class="form-control bg-gray" name="mobile" required="">
                                    </div>
                                    <div class="col-md-12 mb-20">
                                        <label class="mb-2">{{__("apps::frontend.message")}}:</label>
                                        <textarea class="form-control bg-gray" name="message" rows="8" required=""></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" name="submit" type="submit">{{__("apps::frontend.send_btn")}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--============== Contact form End ==============-->




    </div>



@endsection
