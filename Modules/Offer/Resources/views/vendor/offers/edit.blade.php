@extends('apps::vendor.layouts.app')
@section('css')
    <style>
        textarea{
            min-height: 150px;
            max-height: 200px;
        }
        .mb-30{
            margin-bottom: 30px;
        }
        [type="datetime-local"],
        [type="date"]{
            width: 50%;
        }
    </style>
@endsection
@section('title', __('offer::vendor.offers.routes.update'))
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
                        <a href="{{ url(route('vendor.offers.index')) }}">
                            {{ __('offer::vendor.offers.routes.index') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{ __('offer::vendor.offers.routes.update') }}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>
            <div class="row">
                <form id="updateForm" page="form" class="form-horizontal form-row-seperated" method="post"
                    enctype="multipart/form-data" action="{{ route('vendor.offers.update', $model->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">

                        {{-- RIGHT SIDE --}}
                        <div class="col-md-3">
                            <div class="panel-group accordion scrollable" id="accordion2">
                                <div class="panel panel-default">
                                    {{-- <div class="panel-heading">
                                        <h4 class="panel-title"><a class="accordion-toggle"></a></h4>
                                    </div> --}}
                                    <div id="collapse_2_1" class="panel-collapse in">
                                        <div class="panel-body">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li class="active">
                                                    <a href="#global_setting" data-toggle="tab">
                                                        {{ __('offer::vendor.offers.form.tabs.general') }}
                                                    </a>
                                                </li>

                                                <li class="">
                                                    <a href="#category" data-toggle="tab">
                                                        {{ __('offer::vendor.offers.form.tabs.category') }}
                                                    </a>
                                                </li>

                                                <li class="">
                                                    <a href="#use" data-toggle="tab">
                                                        {{ __('offer::vendor.offers.form.tabs.use') }}
                                                    </a>
                                                </li>

                                                <li class="">
                                                    <a href="#media" data-toggle="tab">
                                                        {{ __('offer::vendor.offers.form.tabs.media') }}
                                                    </a>
                                                </li>

                                                <li class="">
                                                    <a href="#location" data-toggle="tab">
                                                        {{ __('offer::vendor.offers.form.tabs.location') }}
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

                                <div class="tab-pane active fade in" id="global_setting">
                                    {{-- <h3 class="page-title">{{__('coupon::vendor.coupons.form.tabs.general')}}</h3> --}}
                                    <div class="col-md-10">

                                        <div>
                                            <div class="tabbable">
                                                <ul class="nav nav-tabs bg-slate nav-tabs-component">
                                                    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
                                                        <li class=" {{ ($code == locale()) ? 'active' : '' }}">
                                                            <a href="#colored-rounded-tab-general-{{$code}}" data-toggle="tab" aria-expanded="false"> {{ $lang['native'] }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <div class="tab-content">
                                                @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
                                                    <div class="tab-pane @if ($code == locale()) active @endif"
                                                         id="colored-rounded-tab-general-{{ $code }}">
                                                        <div class="form-group">
                                                            <label class="col-md-2">
                                                                {{ __('offer::vendor.offers.form.title') }}
                                                            </label>
                                                            <div class="col-md-9">
                                                                <input type="text" name="title[{{ $code }}]"
                                                                       class="form-control"
                                                                       data-name="title.{{ $code }}" value="{{$model->getTranslations('title')[$code]}}">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2">
                                                                {{ __('offer::vendor.offers.form.description') }}
                                                            </label>
                                                            <div class="col-md-9">
                                                                <textarea name="description[{{ $code }}]"
                                                                          class="form-control"
                                                                          data-name="description.{{ $code }}">{{$model->getTranslations('description')[$code] ?? ''}}</textarea>
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-2">
                                                                {{ __('offer::vendor.offers.form.discount_desc') }}
                                                            </label>
                                                            <div class="col-md-9">
                                                                <input type="text" name="discount_desc[{{ $code }}]"
                                                                       class="form-control"
                                                                       data-name="discount_desc.{{ $code }}" value="{{$model->getTranslations('discount_desc')[$code]}}">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2">
                                                                {{ __('offer::vendor.offers.form.details') }}
                                                            </label>
                                                            <div class="col-md-9">
                                                                <textarea name="details[{{ $code }}]"
                                                                          class="form-control"
                                                                          data-name="details.{{ $code }}">{{$model->getTranslations('details')[$code] ?? ''}}</textarea>
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="form-group">
                                                    <label class="col-md-2">
                                                        {{ __('offer::vendor.offers.form.discount_title') }}
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="discount_title"
                                                               class="form-control"
                                                               data-name="discount_title" value="{{$model->discount_title}}">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::vendor.offers.form.quantity') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" id="quantity" data-size="small" value="{{$model->quantity}}" name="quantity">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::vendor.offers.form.price') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="price" data-size="small" value="{{$model->price}}" name="price">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::vendor.offers.form.seller') }}
                                            </label>
                                            <div class="col-md-9">
                                                <select name="seller_id" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($sellers as $seller)
                                                        <option value="{{$seller->id}}" {{$model->seller_id == $seller->id ? 'selected' : ''}}>{{$seller->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::vendor.offers.form.status') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="checkbox" class="make-switch" id="test" data-size="small"
                                                       name="status" {{$model->status ? 'checked' : ''}}>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::vendor.offers.form.is_published') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="checkbox" class="make-switch" id="is_published" data-size="small"
                                                       name="is_published" {{$model->is_published ? 'checked' : ''}}>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="category">
                                    <div class="tab-content">
                                        <div class="tab-pane active fade in" id="category_level">
                                            <h3 class="page-title">{{ __('category::vendor.categories.form.tabs.category_level') }}</h3>
                                            <input type="hidden" id="root_category" name="category_id">
                                            <div id="jstree">
                                                @include('category::dashboard.tree.categories.multi-edit',['mainCategories' => $mainCategories,'hasRelation' => 1,'categories' => $model->categories->pluck('id')->toArray()])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="use">
                                    <div class="col-md-10">
                                        <h3 class="mb-30">{{ __('offer::dashboard.offers.form.website_avail') }}</h3>
                                        {!! field()->dateTime('start_at',__('offer::dashboard.offers.form.start_at'),$model->start_at) !!}
                                        {!! field()->dateTime('expired_at',__('offer::dashboard.offers.form.expired_at'),$model->expired_at) !!}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-md-2">--}}
{{--                                                {{ __('offer::dashboard.offers.form.start_at') }}--}}
{{--                                            </label>--}}
{{--                                            <div class="col-md-9">--}}
{{--                                                <div class="input-group input-medium date time date-picker"--}}
{{--                                                     data-date-format="yyyy-mm-dd" data-date-start-date="+0d">--}}
{{--                                                    <input type="text" id="offer-form" class="form-control"--}}
{{--                                                           name="start_at" data-name="start_at" value="{{$model->start_at}}">--}}
{{--                                                    <span class="input-group-btn">--}}
{{--                                                        <button class="btn default" type="button">--}}
{{--                                                            <i class="fa fa-calendar"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                                <div class="help-block"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-md-2">--}}
{{--                                                {{ __('offer::dashboard.offers.form.expired_at') }}--}}
{{--                                            </label>--}}
{{--                                            <div class="col-md-9">--}}
{{--                                                <div class="input-group input-medium date time date-picker"--}}
{{--                                                     data-date-format="yyyy-mm-dd" data-date-start-date="+0d">--}}
{{--                                                    <input type="text" id="offer-form" class="form-control"--}}
{{--                                                           name="expired_at" data-name="expired_at" value="{{$model->expired_at}}">--}}
{{--                                                    <span class="input-group-btn">--}}
{{--                                                        <button class="btn default" type="button">--}}
{{--                                                            <i class="fa fa-calendar"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                                <div class="help-block"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <h3 class="mb-30"> {{ __('offer::dashboard.offers.form.coupon_avail') }}</h3>
                                        {!! field()->date('user_valid_from',__('offer::dashboard.offers.form.user_valid_from')) !!}
                                        {!! field()->date('user_valid_until',__('offer::dashboard.offers.form.user_valid_until')) !!}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-md-2">--}}
{{--                                                {{ __('offer::dashboard.offers.form.user_valid_from') }}--}}
{{--                                            </label>--}}
{{--                                            <div class="col-md-9">--}}
{{--                                                <div class="input-group input-medium date time date-picker"--}}
{{--                                                     data-date-format="yyyy-mm-dd" data-date-start-date="+0d">--}}
{{--                                                    <input type="text" id="offer-form" class="form-control"--}}
{{--                                                           name="user_valid_from" data-name="user_valid_from" value="{{$model->user_valid_from}}">--}}
{{--                                                    <span class="input-group-btn">--}}
{{--                                                        <button class="btn default" type="button">--}}
{{--                                                            <i class="fa fa-calendar"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                                <div class="help-block"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-md-2">--}}
{{--                                                {{ __('offer::dashboard.offers.form.user_valid_until') }}--}}
{{--                                            </label>--}}
{{--                                            <div class="col-md-9">--}}
{{--                                                <div class="input-group input-medium date time date-picker"--}}
{{--                                                     data-date-format="yyyy-mm-dd" data-date-start-date="+0d">--}}
{{--                                                    <input type="text" id="offer-form" class="form-control"--}}
{{--                                                           name="user_valid_until" data-name="user_valid_until" value="{{$model->user_valid_until}}">--}}
{{--                                                    <span class="input-group-btn">--}}
{{--                                                        <button class="btn default" type="button">--}}
{{--                                                            <i class="fa fa-calendar"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                                <div class="help-block"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::dashboard.offers.form.user_max_uses') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="number" name="user_max_uses" class="form-control"
                                                       data-name="user_max_uses" value="{{$model->user_max_uses}}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade in" id="media">
                                    <div class="tab-content">
                                        <div class="tab-pane active fade in" id="mediaDiv">
                                            <div class="form-group">
                                                <label class="col-md-2">
                                                    {{ __('offer::dashboard.offers.form.image') }}
                                                </label>
                                                <div class="col-md-9">
                                                    @include('offer::dashboard.offers.components.file_preview',[
                                                        'key'=>'main_image',
                                                        'name'=>__('offer::dashboard.offers.form.image'),
                                                        'value' => $model->getMedia('main_image'),
                                                       ])
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2">
                                                    {{ __('offer::dashboard.offers.form.images') }}
                                                </label>
                                                <div class="col-md-9">
                                                    @include('offer::dashboard.offers.components.file_preview',[
                                                        'key'=>'images[]',
                                                        'name'=>__('offer::dashboard.offers.form.images'),
                                                        'value' => $model->getMedia('images'),
                                                        'multiple'  => 'multiple'
                                                       ])
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2">
                                                    {{ __('offer::dashboard.offers.form.video') }}
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="video" data-size="small" name="video" value="{{$model->id ? $model->video : ''}}">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="location">
                                    <div class="col-md-10">
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-md-2">--}}
{{--                                                {{ __('offer::dashboard.offers.form.address_link') }}--}}
{{--                                            </label>--}}
{{--                                            <div class="col-md-9">--}}
{{--                                                <input type="text" class="form-control" id="address_link" data-size="small" value="{{$model->address_link}}" name="address_link">--}}
{{--                                                <div class="help-block"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::vendor.offers.form.city') }}
                                            </label>
                                            <div class="col-md-9">
                                                <select name="city_id" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}" {{$city->id == $model->city_id ? 'selected' :""}}>{{$city->title}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::vendor.offers.form.state') }}
                                            </label>
                                            <div class="col-md-9">
                                                <select name="state_id" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{$state->id == $model->state_id ? 'selected' : ''}}>{{$state->title}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::dashboard.offers.form.lat') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="lat" value="{{$model->lat}}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('offer::dashboard.offers.form.lng') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="lng" value="{{$model->lng}}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- END CREATE FORM --}}
                            </div>
                        </div>

                        {{-- PAGE ACTION --}}
                        <div class="col-md-12">
                            <div class="form-actions">
                                @include('apps::vendor.layouts._ajax-msg')
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-lg green">
                                        {{ __('apps::vendor.buttons.edit') }}
                                    </button>
                                    <a href="{{ url(route('vendor.offers.index')) }}" class="btn btn-lg red">
                                        {{ __('apps::vendor.buttons.back') }}
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

@section('scripts')
    <script>
        $(function(){
            function buildImagePreview(url){
                return '<div class="file-preview-frame float-{{locale() == 'ar' ? 'right' : 'left'}}">'+
                    '<div class="fileinput-remove"><i class="fa fa-times"></i></div>'+
                    `<img src="${url}" class="file-preview-image" title="Screenshot" alt="Screenshot" style="width:160px;height:160px;">`+
                    '</div>'
            }

            function readURL(input, previewId,multiple) {
                if (input.files && input.files[0]) {
                    $.each(input.files,function (index,item){
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            let url = e.target.result
                            let item = buildImagePreview(url);
                            if(!multiple){
                                $(previewId + ' .file-preview-thumbnails').empty();
                            }
                            $(previewId + ' .file-preview-thumbnails').append(item)
                        }
                        reader.readAsDataURL(input.files[index]);
                    })
                }
            }

            $("#images").change(function() {
                readURL(this, '#images_preview',$(this).attr('multiple') == 'multiple' ? true : false);
            });

            $("#main_image").change(function() {
                readURL(this, '#main_image_preview',$(this).attr('multiple') == 'multiple' ? true : false);
            });

            $(".btn-file").on('click',function (){
                $(this).siblings('input[type="file"]')[0].click()
            });

            $(document).on('click','.fileinput-remove',function (){
                if($(this).attr('multiple')){
                    $(this).val('');
                }else{
                    $.ajax({
                        type:'post',
                        url: "{{route('vendor.offers.deleteMediaFiles')}}",
                        data:{
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'id' : [$(this).data('id')]
                        },
                        success: function (data){
                            if(data[0]){
                                toastr['success'](data[1]);
                            }
                        },
                    });
                }
                $(this).parent('.file-preview-frame').remove();
            });
        })
    </script>
    <style>
        .bootstrap-switch{
            max-height: 32px;
        }
        #somecomponent div:nth-child(2){
            /*z-index: -1  !important;*/
        }
    </style>
    <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    <script src="{{asset('admin/js/locationpicker.jquery.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#somecomponent').locationpicker({
                location: {latitude:  "{{$model->lat ?? '29.3759709'}}",  longitude: "{{$model->lng ?? '47.9844442'}}"},
                zoom: 8,
                onchanged: function(currentLocation, radius, isMarkerDropped) {
                    $('input[name="lat"]').val(currentLocation.latitude);
                    $('input[name="lng"]').val(currentLocation.longitude);
                }
            });
            $('#jstree').jstree({
                "plugins" : [ "wholerow", "checkbox" ],
                core: {
                    multiple: true
                }
            });

            $('#jstree').on("changed.jstree", function (e, data) {
                $('#root_category').val(data.selected);
            });

            $('select[name="city_id"]').on('change',function (){
                if($(this).val()){
                    $.ajax({
                        type:'get',
                        url: "{{route('vendor.states.getByCityId',['city_id'=>':id'])}}".replace(':id',$(this).val()),
                        success: function (data){
                            $('select[name="state_id"]').empty().select2('destroy');
                            let x = '<option value=""></option>';
                            $.each(data,function(index,item){
                                x+="<option value='"+item.id+"'>"+item.title+"</option>";
                            });
                            $('select[name="state_id"]').append(x).select2();
                        },
                    });
                }
            });
        });
    </script>

@endsection
