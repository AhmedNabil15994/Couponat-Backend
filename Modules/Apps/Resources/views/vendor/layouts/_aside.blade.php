<div class="page-sidebar-wrapper">

  <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

      <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
          <span></span>
        </div>
      </li>
      <li class="nav-item {{ active_menu('home') }}">
        <a href="{{ url(route('vendor.home')) }}" class="nav-link nav-toggle">
          <i class="icon-home"></i>
          <span class="title">{{ __('apps::vendor.index.title') }}</span>
          <span class="selected"></span>
        </a>
      </li>

        @can('show_statistics')
            <li class="nav-item {{ active_menu('statistics') }}">
                <a href="{{ url(route('vendor.statistics')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('apps::dashboard.index.statistics_title') }}</span>
                    <span class="selected"></span>
                </a>
            </li>
        @endcan

      <li class="heading">
        <h3 class="uppercase">{{ __('apps::vendor._layout.aside._tabs.control') }}</h3>
      </li>

      @can('show_users')
      <li class="nav-item {{ active_menu('users') }}">
        <a href="{{ url(route('vendor.users.index')) }}" class="nav-link nav-toggle">
          <i class="icon-users"></i>
          <span class="title">{{ __('apps::vendor._layout.aside.users') }}</span>
          <span class="selected"></span>
        </a>
      </li>
      @endcan
    @can('show_employees')
        <li class="nav-item {{ active_menu('employees') }}">
            <a href="{{ url(route('vendor.employees.index')) }}" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">{{ __('apps::dashboard._layout.aside.employees') }}</span>
                <span class="selected"></span>
            </a>
        </li>
    @endcan


      @can('show_categories')
      <li class="nav-item  {{ active_menu('categories') }}">
        <a href="{{ url(route('vendor.categories.index')) }}" class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::vendor._layout.aside.categories') }}</span>
        </a>
      </li>
      @endcan

      @can('show_offers')
      <li class="nav-item {{ active_menu('offers') }}">
        <a href="{{ route('vendor.offers.index') }}" class="nav-link nav-toggle">
          <i class="fa fa-building"></i>
          <span class="title">{{ __('apps::vendor._layout.aside.offers') }}</span>
          <span class="selected"></span>
        </a>
      </li>
      @endcan
      @can('show_coupons')
        <li class="nav-item {{ active_menu('coupons') }}">
            <a href="{{ route('vendor.coupons.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-building"></i>
                <span class="title">{{ __('apps::vendor._layout.aside.coupons') }}</span>
                <span class="selected"></span>
            </a>
        </li>
      @endcan
        @can('show_orders')
            <li class="nav-item open  {{active_slide_menu(['orders','pending_orders'])}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">{{ __('apps::vendor._layout.aside._tabs.orders')}}</span>
                    <span class="arrow {{active_slide_menu(['orders'])}}"></span>
                    <span class="selected"></span>
                </a>
                <ul class="sub-menu" style="display: block;">
                  @can('show_orders')
                      <li class="nav-item {{ active_menu('active_orders') }}">
                          <a href="{{ route('vendor.orders.active_orders') }}" class="nav-link nav-toggle">
                              <i class="fa fa-building"></i>
                              <span class="title">{{ __('apps::vendor._layout.aside.active_orders') }}</span>
                              <span class="selected"></span>
                          </a>
                      </li>
                  @endcan
                @can('show_orders')
                  <li class="nav-item {{ active_menu('failed_orders') }}">
                      <a href="{{ route('vendor.orders.failed_orders') }}" class="nav-link nav-toggle">
                          <i class="fa fa-building"></i>
                          <span class="title">{{ __('apps::vendor._layout.aside.failed_orders') }}</span>
                          <span class="selected"></span>
                      </a>
                  </li>
                @endcan
                @can('show_orders')
                    <li class="nav-item {{ active_menu('pending_orders') }}">
                        <a href="{{ route('vendor.orders.pending_orders') }}" class="nav-link nav-toggle">
                            <i class="fa fa-building"></i>
                            <span class="title">{{ __('apps::vendor._layout.aside.pending_orders') }}</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endcan

                @can('show_orders')
                    <li class="nav-item {{ active_menu('orders') }}">
                        <a href="{{ route('vendor.orders.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-building"></i>
                            <span class="title">{{ __('apps::vendor._layout.aside.all_orders') }}</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            <li class="nav-item open  {{active_slide_menu(['reports'])}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">{{ __('apps::dashboard._layout.aside._tabs.reports')}}</span>
                    <span class="arrow {{active_slide_menu(['reports'])}}"></span>
                    <span class="selected"></span>
                </a>
                <ul class="sub-menu" style="display: block;">
                    @can('show_orders')
                        <li class="nav-item {{ active_menu('reports') }}">
                            <a href="{{ route('vendor.reports.vendors') }}" class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">{{ __('apps::dashboard._layout.aside.vendors_sales') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item {{ active_menu('reports') }}">
                            <a href="{{ route('vendor.reports.customers') }}" class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">{{ __('apps::dashboard._layout.aside.customers_sales') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item {{ active_menu('reports') }}">
                            <a href="{{ route('vendor.reports.offers') }}" class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">{{ __('apps::dashboard._layout.aside.offers_sales') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('show_transactions')
            <li class="nav-item  {{ active_slide_menu('transactions') }}">
                <a href="{{ url(route('vendor.transactions.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">{{ __('transaction::vendor.transactions.index.title') }}</span>
                </a>
            </li>
        @endcan

      <li class="heading">
        <h3 class="uppercase">{{ __('apps::vendor._layout.aside._tabs.other') }}</h3>
      </li>

      @canany(['show_countries','show_areas','show_cities','show_states'])
      <li class="nav-item  {{active_slide_menu(['countries','cities','states','areas'])}}">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-pointer"></i>
          <span class="title">{{ __('apps::vendor._layout.aside.countries') }}</span>
          <span class="arrow {{active_slide_menu(['countries','governorates','cities','regions'])}}"></span>
          <span class="selected"></span>
        </a>
        <ul class="sub-menu">

          @can('show_countries')
          <li class="nav-item {{ active_menu('countries') }}">
            <a href="{{ url(route('vendor.countries.index')) }}" class="nav-link nav-toggle">
              <i class="fa fa-building"></i>
              <span class="title">{{ __('apps::vendor._layout.aside.countries') }}</span>
              <span class="selected"></span>
            </a>
          </li>
          @endcan

          @can('show_cities')
          <li class="nav-item {{ active_menu('cities') }}">
            <a href="{{ url(route('vendor.cities.index')) }}" class="nav-link nav-toggle">
              <i class="fa fa-building"></i>
              <span class="title">{{ __('apps::vendor._layout.aside.cities') }}</span>
              <span class="selected"></span>
            </a>
          </li>
          @endcan

          @can('show_states')
          <li class="nav-item {{ active_menu('states') }}">
            <a href="{{ url(route('vendor.states.index')) }}" class="nav-link nav-toggle">
              <i class="fa fa-building"></i>
              <span class="title">{{ __('apps::vendor._layout.aside.state') }}</span>
              <span class="selected"></span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endcanAny
    </ul>
  </div>

</div>
