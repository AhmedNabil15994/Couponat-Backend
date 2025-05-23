@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.admins.create.title'))
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url(route('dashboard.admins.index')) }}">
                        {{__('user::dashboard.admins.index.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('user::dashboard.admins.create.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
                {!! Form::model($model,[
                'url'=> route('dashboard.admins.store'),
                'id'=>'form',
                'role'=>'form',
                'method'=>'POST',
                'class'=>'form-horizontal form-row-seperated',
                'files' => true
                ])!!}





                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable"
                            id="accordion2">
                            <div class="panel panel-default">

                                <div id="collapse_2_1"
                                    class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active">
                                                <a href="#global_setting"
                                                    data-toggle="tab">
                                                    {{ __('user::dashboard.admins.create.form.general') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PAGE CONTENT --}}
                    <div class="col-md-9">
                        <div class="tab-content">

                            {{-- CREATE FORM --}}
                            <div class="tab-pane active fade in"
                                id="global_setting">
                                <div class="col-md-10">
                                    @include('user::dashboard.admins.form.form')
                                </div>
                            </div>
                            {{-- END CREATE FORM --}}

                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit"
                                    id="submit"
                                    class="btn btn-lg blue">
                                    {{__('apps::dashboard.buttons.add')}}
                                </button>
                                <a href="{{url(route('dashboard.admins.index')) }}"
                                    class="btn btn-lg red">
                                    {{__('apps::dashboard.buttons.back')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
           {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
