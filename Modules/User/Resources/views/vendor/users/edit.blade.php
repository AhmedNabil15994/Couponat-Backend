@extends('apps::vendor.layouts.app')
@section('title', __('user::vendor.users.update.title'))
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('vendor.home')) }}">{{ __('apps::vendor.index.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url(route('vendor.users.index')) }}">
                        {{__('user::vendor.users.index.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('user::vendor.users.update.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
                 {!! Form::model($model,[
                                    'url'=> route('vendor.users.update',$model->id),
                                    'id'=>'updateForm',
                                    'role'=>'form',
                                    'method'=>'PUT',

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
                                                    {{ __('user::vendor.users.update.form.general') }}
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

                            {{-- UPDATE FORM --}}
                            <div class="tab-pane active fade in"
                                id="global_setting">
                                <div class="col-md-10">
                                    @include('user::vendor.users.form.form')
                                </div>
                            </div>
                            {{-- END UPDATE FORM --}}
                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::vendor.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit"
                                    id="submit"
                                    class="btn btn-lg green">
                                    {{__('apps::vendor.buttons.edit')}}
                                </button>
                                <a href="{{url(route('vendor.users.index')) }}"
                                    class="btn btn-lg red">
                                    {{__('apps::vendor.buttons.back')}}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@stop
