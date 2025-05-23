@extends('apps::dashboard.layouts.app')
@section('title', __('faq::dashboard.faqs.routes.update'))
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
                        <a href="{{ url(route('dashboard.faqs.index')) }}">
                            {{__('faq::dashboard.faqs.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('faq::dashboard.faqs.routes.update')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">

                {!! Form::model($model,[
                               'url'=> route('dashboard.faqs.update',$model->id),
                               'id'=>'updateForm',
                               'role'=>'form',
                               'page'=>'form',
                               'class'=>'form-horizontal form-row-seperated',
                               'method'=>'PUT',
                               'files' => true
                               ])!!}
                <div class="col-md-12">

                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable" id="accordion2">
                            <div class="panel panel-default">

                                <div id="collapse_2_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">

                                            <li class="active">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('faq::dashboard.faqs.form.tabs.general') }}
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="tab-content">

                            <div class="tab-pane active fade in" id="global_setting">
                                @include('faq::dashboard.faqs.form')
                            </div>

                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg green">
                                    {{__('apps::dashboard.buttons.edit')}}
                                </button>
                                <a href="{{url(route('dashboard.faqs.index')) }}" class="btn btn-lg red">
                                    {{__('apps::dashboard.buttons.back')}}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
@stop
@section('scripts')

    <script type="text/javascript">
        $(function () {

            $('#jstree').jstree({
                core: {
                    multiple: false
                }
            });

            $('#jstree').on("changed.jstree", function (e, data) {
                $('#root_category').val(data.selected);
            });

        });
    </script>

@endsection
