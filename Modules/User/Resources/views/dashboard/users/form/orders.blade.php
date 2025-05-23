<div class="portlet-title" style="margin-bottom: 25px">
    <div class="caption font-dark">
        <i class="icon-settings font-dark"></i>
        <span class="caption-subject bold uppercase">
            {{__('order::dashboard.orders.index.title')}}
          </span>
    </div>
</div>
<div class="portlet-body">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('order::dashboard.orders.datatable.user')}}</th>
                <th>{{__('order::dashboard.orders.datatable.mobile')}}</th>
                <th>{{__('order::dashboard.orders.datatable.email')}}</th>
                <th>{{__('order::dashboard.orders.datatable.total')}}</th>
                <th>{{__('order::dashboard.orders.datatable.status')}}</th>
                <th>{{__('order::dashboard.orders.datatable.created_at')}}</th>
                <th>{{__('order::dashboard.orders.datatable.options')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userData['orders'] as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order?->user?->name}}</td>
                    <td>{{$order?->user?->mobile}}</td>
                    <td>{{$order?->user?->email}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order?->orderStatus?->title}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        @can('show_orders')
                            <a href="{{route('dashboard.orders.show',$order->id)}}" class="btn btn-sm yellow" target="_blank" title="Show">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
