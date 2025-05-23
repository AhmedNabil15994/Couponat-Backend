@extends('apps::dashboard.layouts.app')
@section('title', __('apps::dashboard.index.title'))
@section('css')
<style>
    .mb-25{
      margin-bottom: 25px !important;
    }
</style>
@endsection
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">
                            {{ __('apps::dashboard.index.title') }}
                        </a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> {{ __('apps::dashboard.index.welcome') }} ,
                <small><b style="color:red">{{ Auth::user()->name }} </b></small>
            </h1>

            @can('show_statistics')
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-bubbles font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">
                                {{__('apps::dashboard.datatable.form.date_range')}}
                            </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="filter_data_table">
                            <div class="panel-body row">
                                <div class="col-xs-12">
                                    <form class="horizontal-form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <div id="reportrange" class="btn default form-control">
                                                                <i class="fa fa-calendar"></i> &nbsp;
                                                                <span> </span>
                                                                <b class="fa fa-angle-down"></b>
                                                                <input type="hidden" name="from">
                                                                <input type="hidden" name="to">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <select name="seller_id" id="seller_id" class="form-control select2">
                                                                <option value="">{{ __('apps::dashboard._layout.aside.sellers') }}</option>
                                                                @foreach($data['sellers'] as $seller)
                                                                    <option value="{{$seller->id}}" {{Request::has('seller_id') && Request::get('seller_id') == $seller->id ? 'selected' : ''}}>{{$seller->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions col-md-3">

                                                    <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                            type="submit">
                                                        <i class="fa fa-search"></i>
                                                        {{__('apps::dashboard.datatable.search')}}
                                                    </button>
                                                    <a class="btn btn-sm red btn-outline filter-cancel"
                                                       href="{{url(route('dashboard.statistics'))}}">
                                                        <i class="fa fa-times"></i>
                                                        {{__('apps::dashboard.datatable.reset')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="portlet light bordered col-lg-12">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url(route('dashboard.orders.index'))}}">
                                <div class="visual">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$data['totalOrdersCount']}}">{{$data['totalOrdersCount']}}</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.orders') }}</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                            <a class="dashboard-stat dashboard-stat-v2 orange"  href="{{url(route('dashboard.orders.index'))}}">
                                <div class="visual">
                                  <i class="fa fa-building-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$data['activeOrdersCount']}}">{{$data['activeOrdersCount']}}</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.active_orders') }}</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="{{url(route('dashboard.offers.index'))}}">
                                <div class="visual">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$data['offers']}}">{{$data['offers']}}</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.offers') }}</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                <div class="visual">
                                  <i class="fa fa-building-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$data['activeOffers']}}">{{$data['activeOffers']}}</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.active_coupons') }}</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                          <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                            <div class="visual">
                              <i class="fa fa-users"></i>
                            </div>
                            <div class="details">
                              <div class="number">
                                <span data-counter="counterup" data-value="{{$data['expiredOffers']}}">{{$data['expiredOffers']}}</span>
                              </div>
                              <div class="desc">{{ __('apps::dashboard.index.statistics.expired_coupons') }}</div>
                            </div>
                          </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                          <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                            <div class="visual">
                              <i class="fa fa-users"></i>
                            </div>
                            <div class="details">
                              <div class="number">
                                <span data-counter="counterup" data-value="{{$data['redeemedOffers']}}">{{$data['redeemedOffers']}}</span>
                              </div>
                              <div class="desc">{{ __('apps::dashboard.index.statistics.redeemed_coupons') }}</div>
                            </div>
                          </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$data['unredeemedOffers']}}">{{$data['unredeemedOffers']}}</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.unredeemed_coupons') }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$data['totalRedeemed']}}">{{$data['totalRedeemed']}}</span> {{__('apps::frontend.kd')}}
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.totalRedeemedOffers') }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-25">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$data['totalUnredeemed']}}">{{$data['totalUnredeemed']}}</span>  {{__('apps::frontend.kd')}}
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.totalUnredeemedOffers') }}</div>
                                </div>
                            </a>
                        </div>
                    </div>

{{--                    <div class="portlet light bordered col-lg-12">--}}
{{--                        <div class="portlet-title tabbable-line">--}}
{{--                            <div class="caption">--}}
{{--                                <i class="icon-bubbles font-dark hide"></i>--}}
{{--                                <span class="caption-subject font-dark bold uppercase">--}}
{{--                                {{__('apps::dashboard.index.statistics.titles.orders')}}--}}
{{--                            </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <a class="dashboard-stat dashboard-stat-v2 label-warning"--}}
{{--                               href="{{url(route('dashboard.orders.index'))}}" style="color: white">--}}

{{--                                <div class="visual">--}}
{{--                                    <i class="fa fa-shopping-cart"></i>--}}
{{--                                </div>--}}
{{--                                <div class="details">--}}
{{--                                    <div class="number">--}}
{{--                                        <span data-counter="counterup" data-value="{{$data['pendingOrdersCount']}}">{{$data['pendingOrdersCount']}}</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="desc">{{ __('apps::dashboard.index.statistics.pending_orders') }}</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-3">--}}
{{--                            <a class="dashboard-stat dashboard-stat-v2 green-dark"--}}
{{--                               href="{{url(route('dashboard.orders.index'))}}" style="color: white">--}}

{{--                                <div class="visual">--}}
{{--                                    <i class="fa fa-shopping-cart"></i>--}}
{{--                                </div>--}}
{{--                                <div class="details">--}}
{{--                                    <div class="number">--}}
{{--                                        <span data-counter="counterup" data-value="{{$data['activeOrdersCount']}}">{{$data['activeOrdersCount']}}</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="desc">{{ __('apps::dashboard.index.statistics.active_orders') }}</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <a class="dashboard-stat dashboard-stat-v2 label-primary"--}}
{{--                               href="{{url(route('dashboard.orders.index'))}}" style="color: white">--}}

{{--                                <div class="visual">--}}
{{--                                    <i class="fa fa-shopping-cart"></i>--}}
{{--                                </div>--}}
{{--                                <div class="details">--}}
{{--                                    <div class="number">--}}
{{--                                        <span data-counter="counterup" data-value="{{$data['totalOrdersCount']}}">{{$data['totalOrdersCount']}}</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="desc">{{ __('apps::dashboard.index.statistics.total_orders') }}</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-3">--}}
{{--                            <a class="dashboard-stat dashboard-stat-v2 label-danger"--}}
{{--                               href="{{url(route('dashboard.orders.index'))}}" style="color: white">--}}

{{--                                <div class="visual">--}}
{{--                                    <i class="fa fa-shopping-cart"></i>--}}
{{--                                </div>--}}
{{--                                <div class="details">--}}
{{--                                    <div class="number">--}}
{{--                                        <span data-counter="counterup" data-value="{{$data['totalOrdersProfit']}} ">{{$data['totalOrdersProfit']}}</span> {{__('apps::frontend.kd')}}--}}
{{--                                    </div>--}}
{{--                                    <div class="desc">{{ __('apps::dashboard.index.statistics.total_profit') }}</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light portlet-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green bold uppercase">
                                {{ __('apps::dashboard.home.statistics.title') }}
                            </span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="mt-element-card mt-card-round mt-element-overlay">
                                    <div class="row">
                                        <div class="general-item-list">

                                            <div class="col-md-6">
                                                <b class="page-title">
                                                    {{ __('apps::dashboard.home.statistics.users_created_at') }}
                                                </b>
                                                <canvas id="myChart2" width="540" height="270"></canvas>
                                            </div>

                                            <div class="col-md-6">
                                                <b class="page-title">
                                                    {{ __('apps::dashboard.home.statistics.orders_monthly') }}
                                                </b>
                                                <canvas id="monthlyOrders" width="540" height="270"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>

@stop
@section('scripts')
  @include('apps::dashboard.layouts._js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

  <script>
      // USERS COUNT BY DATE
      var ctx = document.getElementById("myChart2").getContext('2d');
      var labels = {!!$data['userCreated']['userDate'] !!};
      var countDate = {!!$data['userCreated']['countDate'] !!};
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: labels,
              datasets: [{
                  label: '{{ __('apps::dashboard.home.statistics.users_created_at') }}',
                  data: countDate,
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54 , 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75 , 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54 , 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75 , 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });


      var ctx = document.getElementById("monthlyOrders");
      var labels = {!!$data['monthlyOrders']['orders_dates'] !!};
      var count = {!!$data['monthlyOrders']['profits'] !!};
      var data = {
          labels: labels,
          datasets: [{
              label: "{{ __('apps::dashboard.home.statistics.orders_monthly') }}",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "#36A2EB",
              borderColor: "#36A2EB",
              borderCapStyle: 'butt',
              borderDash: [],
              borderDashOffset: 0.0,
              borderJoinStyle: 'miter',
              pointBorderColor: "#36A2EB",
              pointBackgroundColor: "#fff",
              pointBorderWidth: 1,
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "#36A2EB",
              pointHoverBorderColor: "#FFCE56",
              pointHoverBorderWidth: 2,
              pointRadius: 1,
              pointHitRadius: 10,
              data: count,
              spanGaps: false,
          }]
      };
      var myLineChart = new Chart(ctx, {
          type: 'line',
          label: labels,
          data: data,
          options: {
              animation: {
                  animateScale: true
              }
          }
      });


  </script>

@endsection
