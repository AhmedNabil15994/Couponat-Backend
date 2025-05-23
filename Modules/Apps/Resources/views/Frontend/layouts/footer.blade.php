</main>
<footer id="site-footer" class="footer-page">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-12">
                <div class="widget-footer footer-side-nav">
                    <ul class="footer-list">
                        <li class="footer-list-item">
                            <span class="list-item-text">
                                <a href="{{route('frontend.about_us')}}">{{__('apps::frontend.about_us')}}</a>
                            </span>
                        </li>
                        <li class="footer-list-item">
                            <span class="list-item-text">
                                <a href="{{route('frontend.terms')}}">{{__('apps::frontend.terms')}}</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="widget-footer footer-side-nav">
                    <ul class="footer-list">
                        <li class="footer-list-item">
                            <span class="list-item-text">
                                <a href="{{URL::to('/')}}">{{__('apps::frontend.home')}}</a>
                            </span>
                        </li>
                        <li class="footer-list-item">
                            <span class="list-item-text">
                                <a href="{{route('frontend.contact_us')}}">{{__('apps::frontend.contact_us')}}</a>
                            </span>
                        </li>
                        <li class="footer-list-item">
                            <span class="list-item-text">
                                <a href="{{route('frontend.faq')}}">{{__('apps::frontend.faq')}}</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="footer-help">
                    <div class="footer-contact wow fadeInUp">
                        <h4>{{__('apps::frontend.follow_us')}}</h4>
                        <div class="footer-social">
                            @if(setting('social')['facebook'] != '')
                            <a href="{{setting('social')['facebook'] ?? '#'}}" target="_blank"><i class="ti-facebook"></i></a>
                            @endif
                            @if(setting('social')['twitter'] != '')
                            <a href="{{setting('social')['twitter'] ?? '#'}}" target="_blank">
                                <img src="{{asset('frontend/assets/images/x-twitter.svg')}}" />
                            </a>
                            @endif
                            @if(setting('social')['instagram'] != '')
                            <a href="{{setting('social')['instagram'] ?? '#'}}" target="_blank"><i class="ti-instagram"></i></a>
                            @endif
                            @if(setting('social')['youtube'] != '')
                            <a href="{{setting('social')['youtube'] ?? '#'}}" target="_blank"><i class="ti-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                @if(setting('app_links')['google_play'] != '' && setting('app_links')['app_store'] !='')
                <div class="app-download">
                    <div class="app-desc wow fadeInUp">
                        <h2>{{__('apps::frontend.download_app')}}</h2>
                        <div class=" d-flex justify-content-center flex-wrap">
                            @if(setting('app_links')['app_store'] != '')
                            <a class="download-btn" href="{{setting('app_links')['app_store'] ?? '#'}}" target="_blank">
                                <img class="img-fluid" src="{{asset('frontend/assets/images/apple.svg')}}" alt="" />
                            </a>
                            @endif
                            @if(setting('app_links')['google_play'] != '')
                            <a class="download-btn" href="{{setting('app_links')['google_play'] ?? '#'}}" target="_blank">
                                <img class="img-fluid" src="{{asset('frontend/assets/images/google.svg')}}" alt="" />
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <div class="copyRight">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <span>© {{date('Y')}} couponat.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-nav">
        <ul class="nav nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="{{url(route('frontend.home'))}}">
                    <i class="bi bi-house"></i>
                    <span>{{__('apps::frontend.home')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('frontend.profile.favourites.index')}}">
                    <i class="bi bi-heart"></i>
                    <span>{{__('apps::frontend.favorite')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.cart.index') }}">
                    <i class="bi bi-bag"></i>
                    <span>{{__('apps::frontend.cart')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('frontend.profile.index')}}">
                    <i class="bi bi-person"></i>
                    <span>{{__('apps::frontend.account')}}</span>
                </a>
            </li>
        </ul>
    </div>
</footer>
<div class="loader"></div>
@if(setting('contact_us')['whatsapp'] != '')
<div class="whatsapp-icon">
    <a href="https://wa.me/{{setting('contact_us')['whatsapp']?? ''}}?text={{__('apps::frontend.how_help')}}" target="_blank">
        <img src="{{asset('frontend/assets/images/whatsapp.gif')}}" />
    </a>
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="filter-modal" tabindex="-1" aria-labelledby="Filters" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="Filters">{{__('apps::frontend.filter_by_govern')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="get" id="mainSearchForm" action="{{URL::current()}}">
                <div class="modal-body">
                    <div class="row filter-option">
                        <input type="hidden" name="search" value="{{request()->search}}">
                        @inject('cities','Modules\Area\Entities\City')
                        @foreach($cities->active()->get() as $city)
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck{{$city->id}}" name="city_id[]" value="{{$city->id}}">
                                <label class="custom-control-label" for="customCheck{{$city->id}}">{{$city->title}}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary rounded-pill btn-w100">{{__('apps::frontend.apply')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>


