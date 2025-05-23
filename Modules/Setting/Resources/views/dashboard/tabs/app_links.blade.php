<div class="tab-pane fade" id="app_links">
  <h3 class="page-title">{{ __('app links') }}</h3>
  <div class="col-md-10">
    {!! field()->text('app_links[google_play]' , __('google play') , setting('app_links','google_play') ) !!}
    {!! field()->text('app_links[app_store]' , __('app store') , setting('app_links','app_store') ) !!}
    {!! field()->text('app_links[app_gallery]' , __('app gallery') , setting('app_links','app_gallery') ) !!}
  </div>
</div>
