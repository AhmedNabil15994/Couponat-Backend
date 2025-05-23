@extends('apps::vendor.layouts.app')
@section('title', __('category::vendor.categories.routes.update'))
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
                    <a href="{{ url(route('vendor.categories.index')) }}">
                        {{__('category::vendor.categories.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('category::vendor.categories.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            {!! Form::model($model,[
                          'url'=> route('vendor.categories.update',$model->id),
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
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle"></a></h4>
                                </div>
                                <div id="collapse_2_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active">
                                                <a href="#category_level" data-toggle="tab">
                                                    {{ __('category::vendor.categories.form.tabs.category_level') }}
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('category::vendor.categories.form.tabs.general') }}
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
                            <div class="tab-pane active fade in" id="category_level">
                                <h3 class="page-title">{{ __('category::vendor.categories.form.tabs.category_level') }}</h3>
                                <div id="jstree">
                                    <ul>
                                        <li id="null"
                                          @if ($model->category_id == null)
                                            data-jstree='{"selected":true}'
                                          @endif>
                                          {{ __('category::vendor.categories.form.main_category') }}
                                        </li>
                                    </ul>
                                    @include('category::vendor.tree.categories.edit',['mainCategories' => $mainCategories])
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="global_setting">
                                <div class="col-md-10">
                                    @include('category::vendor.categories.form')
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::vendor.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg green">
                                    {{__('apps::vendor.buttons.edit')}}
                                </button>
                                <a href="{{url(route('vendor.categories.index')) }}" class="btn btn-lg red">
                                    {{__('apps::vendor.buttons.back')}}
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
    $(function() {

        $('#jstree').jstree({
            core: {
                multiple: false
            }
        });

        $('#jstree').on("changed.jstree", function(e, data) {
            $('#root_category').val(data.selected);
        });

    });
</script>

@endsection
