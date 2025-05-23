@extends('apps::dashboard.layouts.app')
@section('title', __('notification::dashboard.notifications.routes.create'))
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.home.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('dashboard.notifications.index')) }}">{{__('notification::dashboard.notifications.routes.index')}}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="javascript:;">{{__('notification::dashboard.notifications.routes.create')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                     {!! Form::open([
                                        'url'=> route('dashboard.notifications.store'),
                                        'id'=>'form',
                                        'role'=>'form',
                                        'method'=>'POST',
                                        'class'=>'form-horizontal form-row-seperated',
                                        'files' => true
                                        ])!!}
                    <div class="col-md-12 justify-content-center">
                        <div class="col-md-6 col-md-offset-3">
                        @include('notification::dashboard.notifications.form')
                        </div>
                        {{-- END CREATE FORM --}}

                        {{-- PAGE ACTION --}}
                        <div class="col-md-12">
                            <div class="form-actions text-center">
                                @include('apps::dashboard.layouts._ajax-msg')
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-lg blue">
                                        {{__('notification::dashboard.notifications.send_btn')}}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

