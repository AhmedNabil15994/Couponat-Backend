<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url(route('frontend.home'))}}">
                <img src="{{asset(setting('logo'))}}" class="logo" alt="logo" />
            </a>
            <div class="d-flex mx-lg-auto form">
                <input class="form-control rounded-pill" id="search" value="{{request()->search}}" type="search" placeholder="{{__('apps::frontend.start_search')}}" aria-label="Search">
                <button class="btn btn-info btn-search rounded-circle"  type="button" data-toggle="modal" data-target="#filter-modal">
                    <i class="bi bi-sliders"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse pull-right" id="navbarScroll">
                <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                    <li class="nav-item cart-icon">
                        <a class="nav-link" href="{{ route('frontend.cart.index') }}">
                            @auth
                                @php $cartCount = Cart::session(request()->user()->id)->getContent()->count(); @endphp
                            @else
                                @php
                                    $token = request()->has('user_token') ? request()->get('user_token') : session()->get('user_token');
                                    $cartCount = !is_null($token) ? Cart::session( $token )->getContent()->count() : 0;
                                @endphp
                            @endif
                            <i class="bi bi-bag-fill"></i>
                            <span class="cart-num">{{$cartCount}}</span>
                        </a>
                    </li>

                    @foreach (config('laravellocalization.supportedLocales') as $localeCode => $properties)
                        @if ($localeCode != locale())
                            <li class="nav-item languege">
                                <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <i class="bi bi-globe"></i> {{ $properties['native'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle border rounded-pill" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list"></i>
                            <img src="{{asset('frontend/assets/images/user.png')}}">
                        </a>
                        <ul class="dropdown-menu">
                            @auth()
                            <li><a class="dropdown-item" href="{{route('frontend.profile.favourites.index')}}">{{__('apps::frontend.favorite')}}</a></li>
                            <li><a class="dropdown-item" href="{{route('frontend.profile.index')}}">{{__('apps::frontend.profile')}}</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{URL::to('/logout')}}">{{__('apps::frontend.sign_out')}}</a></li>
                            @else
                            <li><a class="dropdown-item" href="{{route('frontend.auth.register')}}" >{{__('apps::frontend.sign_up')}}</a></li>
                            <li><a class="dropdown-item" href="{{route('frontend.auth.login')}}" >{{__('apps::frontend.sign_in')}}</a></li>
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="menu-mobile desk-none">
        <div class="navbar-nav mr-auto my-2 my-lg-0" style="max-height: 100px;">
            <div class="pulls-right ">
                <div class="nav-item cart-icon">
                    <a class="nav-link" href="{{ route('frontend.cart.index') }}">
                        <i class="bi bi-bag-fill"></i>
                        <span class="cart-num">{{$cartCount}}</span>
                    </a>
                </div>
                @foreach (config('laravellocalization.supportedLocales') as $localeCode => $properties)
                    @if ($localeCode != locale())
                    <div class="nav-item languege">
                        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <i class="bi bi-globe"></i> {{ $properties['native'] }}
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="pulls-left">
                <div class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle border rounded-pill" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                        <img src="{{asset('frontend/assets/images/user.png')}}">
                    </a>
                    <ul class="dropdown-menu">
                        @auth()
                        <li><a class="dropdown-item" href="{{route('frontend.profile.favourites.index')}}">{{__('apps::frontend.favorite')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('frontend.profile.index')}}">{{__('apps::frontend.profile')}}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{URL::to('/logout')}}">{{__('apps::frontend.sign_out')}}</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{route('frontend.auth.register')}}">{{__('apps::frontend.sign_up')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('frontend.auth.login')}}">{{__('apps::frontend.sign_in')}}</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <section class="filter-section" style="margin-bottom: 0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        @php
                            $requestCategory = \Request::route()?->parameters['category'] ?? null;
                            $requestCategory = $requestCategory != null ? $requestCategory->id : 0;
                        @endphp
                        <div class="col-xl-12 col-lg-12">
                            <div class="owl-carousel owl-theme ctg-main filter-active">
                                @inject('categories','Modules\Category\Entities\Category')
                                @foreach($categories->active()->where('category_id',null)->orderBy('order','asc')->get() as $catKey => $category)
                                <a href="{{ route('frontend.categories.show',['category'=>$category->id])}}" data-to="{{$catKey}}" class="slideItem {{$category->id == $requestCategory ? 'active' : ''}} filter" data-filter="*">
                                    <img src="{{asset($category->getFirstMediaUrl('images'))}}" class="icon-filter" alt="icon" />
                                    <span class="d-block">{{$category->title}}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
