@extends('apps::dashboard.layouts.app')
@section('title', __('setting::dashboard.settings.routes.index'))
@section('css')
    <style>
        @charset "UTF-8";:root{--tagify-dd-color-primary:rgb(53,149,246);--tagify-dd-bg-color:white;--tagify-dd-item-pad:.3em .5em}.tagify{--tags-disabled-bg:#F1F1F1;--tags-border-color:#DDD;--tags-hover-border-color:#CCC;--tags-focus-border-color:#3595f6;--tag-border-radius:3px;--tag-bg:#E5E5E5;--tag-hover:#D3E2E2;--tag-text-color:black;--tag-text-color--edit:black;--tag-pad:0.3em 0.5em;--tag-inset-shadow-size:1.1em;--tag-invalid-color:#D39494;--tag-invalid-bg:rgba(211, 148, 148, 0.5);--tag-remove-bg:rgba(211, 148, 148, 0.3);--tag-remove-btn-color:black;--tag-remove-btn-bg:none;--tag-remove-btn-bg--hover:#c77777;--input-color:inherit;--tag--min-width:1ch;--tag--max-width:auto;--tag-hide-transition:0.3s;--placeholder-color:rgba(0, 0, 0, 0.4);--placeholder-color-focus:rgba(0, 0, 0, 0.25);--loader-size:.8em;--readonly-striped:1;display:inline-flex;align-items:flex-start;flex-wrap:wrap;border:1px solid var(--tags-border-color);padding:0;line-height:0;cursor:text;outline:0;position:relative;box-sizing:border-box;transition:.1s}@keyframes tags--bump{30%{transform:scale(1.2)}}@keyframes rotateLoader{to{transform:rotate(1turn)}}.tagify:hover:not(.tagify--focus):not(.tagify--invalid){--tags-border-color:var(--tags-hover-border-color)}.tagify[disabled]{background:var(--tags-disabled-bg);filter:saturate(0);opacity:.5;pointer-events:none}.tagify[disabled].tagify--select,.tagify[readonly].tagify--select{pointer-events:none}.tagify[disabled]:not(.tagify--mix):not(.tagify--select),.tagify[readonly]:not(.tagify--mix):not(.tagify--select){cursor:default}.tagify[disabled]:not(.tagify--mix):not(.tagify--select)>.tagify__input,.tagify[readonly]:not(.tagify--mix):not(.tagify--select)>.tagify__input{visibility:hidden;width:0;margin:5px 0}.tagify[disabled]:not(.tagify--mix):not(.tagify--select) .tagify__tag>div,.tagify[readonly]:not(.tagify--mix):not(.tagify--select) .tagify__tag>div{padding:var(--tag-pad)}.tagify[disabled]:not(.tagify--mix):not(.tagify--select) .tagify__tag>div::before,.tagify[readonly]:not(.tagify--mix):not(.tagify--select) .tagify__tag>div::before{animation:readonlyStyles 1s calc(-1s * (var(--readonly-striped) - 1)) paused}@keyframes readonlyStyles{0%{background:linear-gradient(45deg,var(--tag-bg) 25%,transparent 25%,transparent 50%,var(--tag-bg) 50%,var(--tag-bg) 75%,transparent 75%,transparent) 0/5px 5px;box-shadow:none;filter:brightness(.95)}}.tagify[disabled] .tagify__tag__removeBtn,.tagify[readonly] .tagify__tag__removeBtn{display:none}.tagify--loading .tagify__input>br:last-child{display:none}.tagify--loading .tagify__input::before{content:none}.tagify--loading .tagify__input::after{content:"";vertical-align:middle;opacity:1;width:.7em;height:.7em;width:var(--loader-size);height:var(--loader-size);min-width:0;border:3px solid;border-color:#eee #bbb #888 transparent;border-radius:50%;animation:rotateLoader .4s infinite linear;content:""!important;margin:-2px 0 -2px .5em}.tagify--loading .tagify__input:empty::after{margin-left:0}.tagify+input,.tagify+textarea{position:absolute!important;left:-9999em!important;transform:scale(0)!important}.tagify__tag{display:inline-flex;align-items:center;margin:5px 0 5px 5px;position:relative;z-index:1;outline:0;line-height:normal;cursor:default;transition:.13s ease-out}.tagify__tag>div{vertical-align:top;box-sizing:border-box;max-width:100%;padding:var(--tag-pad);color:var(--tag-text-color);line-height:inherit;border-radius:var(--tag-border-radius);white-space:nowrap;transition:.13s ease-out}.tagify__tag>div>*{white-space:pre-wrap;overflow:hidden;text-overflow:ellipsis;display:inline-block;vertical-align:top;min-width:var(--tag--min-width);max-width:var(--tag--max-width);transition:.8s ease,.1s color}.tagify__tag>div>[contenteditable]{outline:0;-webkit-user-select:text;user-select:text;cursor:text;margin:-2px;padding:2px;max-width:350px}.tagify__tag>div::before{content:"";position:absolute;border-radius:inherit;inset:var(--tag-bg-inset,0);z-index:-1;pointer-events:none;transition:120ms ease;animation:tags--bump .3s ease-out 1;box-shadow:0 0 0 var(--tag-inset-shadow-size) var(--tag-bg) inset}.tagify__tag:focus div::before,.tagify__tag:hover:not([readonly]) div::before{--tag-bg-inset:-2.5px;--tag-bg:var(--tag-hover)}.tagify__tag--loading{pointer-events:none}.tagify__tag--loading .tagify__tag__removeBtn{display:none}.tagify__tag--loading::after{--loader-size:.4em;content:"";vertical-align:middle;opacity:1;width:.7em;height:.7em;width:var(--loader-size);height:var(--loader-size);min-width:0;border:3px solid;border-color:#eee #bbb #888 transparent;border-radius:50%;animation:rotateLoader .4s infinite linear;margin:0 .5em 0 -.1em}.tagify__tag--flash div::before{animation:none}.tagify__tag--hide{width:0!important;padding-left:0;padding-right:0;margin-left:0;margin-right:0;opacity:0;transform:scale(0);transition:var(--tag-hide-transition);pointer-events:none}.tagify__tag--hide>div>*{white-space:nowrap}.tagify__tag.tagify--noAnim>div::before{animation:none}.tagify__tag.tagify--notAllowed:not(.tagify__tag--editable) div>span{opacity:.5}.tagify__tag.tagify--notAllowed:not(.tagify__tag--editable) div::before{--tag-bg:var(--tag-invalid-bg);transition:.2s}.tagify__tag[readonly] .tagify__tag__removeBtn{display:none}.tagify__tag[readonly]>div::before{animation:readonlyStyles 1s calc(-1s * (var(--readonly-striped) - 1)) paused}@keyframes readonlyStyles{0%{background:linear-gradient(45deg,var(--tag-bg) 25%,transparent 25%,transparent 50%,var(--tag-bg) 50%,var(--tag-bg) 75%,transparent 75%,transparent) 0/5px 5px;box-shadow:none;filter:brightness(.95)}}.tagify__tag--editable>div{color:var(--tag-text-color--edit)}.tagify__tag--editable>div::before{box-shadow:0 0 0 2px var(--tag-hover) inset!important}.tagify__tag--editable>.tagify__tag__removeBtn{pointer-events:none}.tagify__tag--editable>.tagify__tag__removeBtn::after{opacity:0;transform:translateX(100%) translateX(5px)}.tagify__tag--editable.tagify--invalid>div::before{box-shadow:0 0 0 2px var(--tag-invalid-color) inset!important}.tagify__tag__removeBtn{order:5;display:inline-flex;align-items:center;justify-content:center;border-radius:50px;cursor:pointer;font:14px/1 Arial;background:var(--tag-remove-btn-bg);color:var(--tag-remove-btn-color);width:14px;height:14px;margin-right:4.6666666667px;margin-left:auto;overflow:hidden;transition:.2s ease-out}.tagify__tag__removeBtn::after{content:"×";transition:.3s,color 0s}.tagify__tag__removeBtn:hover{color:#fff;background:var(--tag-remove-btn-bg--hover)}.tagify__tag__removeBtn:hover+div>span{opacity:.5}.tagify__tag__removeBtn:hover+div::before{box-shadow:0 0 0 var(--tag-inset-shadow-size) var(--tag-remove-bg,rgba(211,148,148,.3)) inset!important;transition:box-shadow .2s}.tagify:not(.tagify--mix) .tagify__input br{display:none}.tagify:not(.tagify--mix) .tagify__input *{display:inline;white-space:nowrap}.tagify__input{flex-grow:1;display:inline-block;min-width:110px;margin:5px;padding:var(--tag-pad);line-height:normal;position:relative;white-space:pre-wrap;color:var(--input-color);box-sizing:inherit}.tagify__input:empty::before{position:static}.tagify__input:focus{outline:0}.tagify__input:focus::before{transition:.2s ease-out;opacity:0;transform:translatex(6px)}@supports (-ms-ime-align:auto){.tagify__input:focus::before{display:none}}.tagify__input:focus:empty::before{transition:.2s ease-out;opacity:1;transform:none;color:rgba(0,0,0,.25);color:var(--placeholder-color-focus)}@-moz-document url-prefix(){.tagify__input:focus:empty::after{display:none}}.tagify__input::before{content:attr(data-placeholder);height:1em;line-height:1em;margin:auto 0;z-index:1;color:var(--placeholder-color);white-space:nowrap;pointer-events:none;opacity:0;position:absolute}.tagify__input::after{content:attr(data-suggest);display:inline-block;vertical-align:middle;position:absolute;min-width:calc(100% - 1.5em);text-overflow:ellipsis;overflow:hidden;white-space:pre;color:var(--tag-text-color);opacity:.3;pointer-events:none;max-width:100px}.tagify__input .tagify__tag{margin:0 1px}.tagify--mix{display:block}.tagify--mix .tagify__input{padding:5px;margin:0;width:100%;height:100%;line-height:1.5;display:block}.tagify--mix .tagify__input::before{height:auto;display:none;line-height:inherit}.tagify--mix .tagify__input::after{content:none}.tagify--select::after{content:">";opacity:.5;position:absolute;top:50%;right:0;bottom:0;font:16px monospace;line-height:8px;height:8px;pointer-events:none;transform:translate(-150%,-50%) scaleX(1.2) rotate(90deg);transition:.2s ease-in-out}.tagify--select[aria-expanded=true]::after{transform:translate(-150%,-50%) rotate(270deg) scaleY(1.2)}.tagify--select .tagify__tag{position:absolute;top:0;right:1.8em;bottom:0}.tagify--select .tagify__tag div{display:none}.tagify--select .tagify__input{width:100%}.tagify--empty .tagify__input::before{transition:.2s ease-out;opacity:1;transform:none;display:inline-block;width:auto}.tagify--mix .tagify--empty .tagify__input::before{display:inline-block}.tagify--focus{--tags-border-color:var(--tags-focus-border-color);transition:0s}.tagify--invalid{--tags-border-color:#D39494}.tagify__dropdown{position:absolute;z-index:9999;transform:translateY(1px);overflow:hidden}.tagify__dropdown[placement=top]{margin-top:0;transform:translateY(-100%)}.tagify__dropdown[placement=top] .tagify__dropdown__wrapper{border-top-width:1.1px;border-bottom-width:0}.tagify__dropdown[position=text]{box-shadow:0 0 0 3px rgba(var(--tagify-dd-color-primary),.1);font-size:.9em}.tagify__dropdown[position=text] .tagify__dropdown__wrapper{border-width:1px}.tagify__dropdown__wrapper{max-height:300px;overflow:auto;overflow-x:hidden;background:var(--tagify-dd-bg-color);border:1px solid;border-color:var(--tagify-dd-color-primary);border-bottom-width:1.5px;border-top-width:0;box-shadow:0 2px 4px -2px rgba(0,0,0,.2);transition:.25s cubic-bezier(0,1,.5,1)}.tagify__dropdown__header:empty{display:none}.tagify__dropdown__footer{display:inline-block;margin-top:.5em;padding:var(--tagify-dd-item-pad);font-size:.7em;font-style:italic;opacity:.5}.tagify__dropdown__footer:empty{display:none}.tagify__dropdown--initial .tagify__dropdown__wrapper{max-height:20px;transform:translateY(-1em)}.tagify__dropdown--initial[placement=top] .tagify__dropdown__wrapper{transform:translateY(2em)}.tagify__dropdown__item{box-sizing:border-box;padding:var(--tagify-dd-item-pad);margin:1px;white-space:pre-wrap;cursor:pointer;border-radius:2px;position:relative;outline:0;max-height:60px;max-width:100%}.tagify__dropdown__item--active{background:var(--tagify-dd-color-primary);color:#fff}.tagify__dropdown__item:active{filter:brightness(105%)}.tagify__dropdown__item--hidden{padding-top:0;padding-bottom:0;margin:0 1px;pointer-events:none;overflow:hidden;max-height:0;transition:var(--tagify-dd-item--hidden-duration,.3s)!important}.tagify__dropdown__item--hidden>*{transform:translateY(-100%);opacity:0;transition:inherit}
    </style>
@endsection
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
          <a href="#">{{ __('setting::dashboard.settings.routes.index') }}</a>
        </li>
      </ul>
    </div>
    <h1 class="page-title"></h1>
    @include('apps::dashboard.layouts._msg')
    <div class="row">
      <form role="form" id="updateForm" class="form-horizontal form-row-seperated" method="post" action="{{route('dashboard.setting.update')}}"
        enctype="multipart/form-data">
        <div class="col-md-12">
          @csrf
          <div class="col-md-3">
            <div class="panel-group accordion scrollable" id="accordion2">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle"> {{__('setting::dashboard.settings.form.tabs.info')}}
                    </a>
                  </h4>
                </div>
                <div id="collapse_2_1" class="panel-collapse in">
                  <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                      <li class="active">
                        <a href="#global_setting" data-toggle="tab">
                          {{ __('setting::dashboard.settings.form.tabs.general') }}
                        </a>
                      </li>
                      <li>
                        <a href="#app" data-toggle="tab">
                          {{ __('setting::dashboard.settings.form.tabs.app') }}
                        </a>
                      </li>
                      <li>
                        <a href="#mail" data-toggle="tab">
                          {{ __('setting::dashboard.settings.form.tabs.mail') }}
                        </a>
                      </li>
                      <li>
                        <a href="#logo" data-toggle="tab">
                          {{ __('setting::dashboard.settings.form.tabs.logo') }}
                        </a>
                      </li>
                      <li>
                        <a href="#social_media" data-toggle="tab">
                          {{ __('setting::dashboard.settings.form.tabs.social_media') }}
                        </a>
                      </li>

                      <li>
                        <a href="#other" data-toggle="tab">
                          {{ __('setting::dashboard.settings.form.tabs.other') }}
                        </a>
                      </li>
                      <li>
                        <a href="#payment_gateway" data-toggle="tab">
                          {{ __('setting::dashboard.settings.form.tabs.payment_gateway') }}
                        </a>
                      </li>
                      <li>
                        <a href="#app_links" data-toggle="tab">
                          {{ __('app links') }}
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
              @include('setting::dashboard.tabs.general')
              @include('setting::dashboard.tabs.app')
              @include('setting::dashboard.tabs.app_links')
              @include('setting::dashboard.tabs.logo')
              @include('setting::dashboard.tabs.social')
              @include('setting::dashboard.tabs.mail')
              @include('setting::dashboard.tabs.other')
              @include('setting::dashboard.tabs.payment_gateway')
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-md-9">
              <button type="submit" id="submit" class="btn btn-lg blue">
                {{__('apps::dashboard.buttons.edit')}}
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
@push('scripts')
<script>
  var sideMenuReviewProducts = $('#sideMenuReviewProducts');
  function paymentModeSwitcher(hide_class,show_id){
    $('.'+hide_class).hide();
    $('#'+show_id).show();
  }


</script>

@endpush
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.min.js"></script>
    <script>
        $(function (){
            var input = document.querySelector('.basic');


            // initialize Tagify on the above input node reference
            new Tagify(input)

            $(input).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        })
        function paymentModeSwitcher(itemClass,div){
            $('.'+itemClass).hide();
            $('.'+itemClass + '#'+div).show();
        }
    </script>
@endsection
