<div class="portlet-title" style="margin-bottom: 25px">
    <div class="caption font-dark">
        <i class="icon-settings font-dark"></i>
        <span class="caption-subject bold uppercase">
            {{__('transaction::dashboard.transactions.index.title')}}
      </span>
    </div>
</div>
<div class="portlet-body">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('transaction::dashboard.transactions.datatable.payment_id')}}</th>
            <th>{{__('transaction::dashboard.transactions.datatable.method')}}</th>
            <th>{{__('transaction::dashboard.transactions.datatable.result')}}</th>
            <th>{{__('transaction::dashboard.transactions.datatable.track_id')}}</th>
            <th>{{__('transaction::dashboard.transactions.datatable.ref')}}</th>
            <th>{{__('order::dashboard.orders.datatable.total')}}</th>
            <th>{{__('transaction::dashboard.transactions.datatable.created_at')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($userData['transactions'] as $transaction)
            <tr>
                <td>{{$transaction->id}}</td>
                <td>{{$transaction->payment_id}}</td>
                <td>{{$transaction->method}}</td>
                <td>{{$transaction->result}}</td>
                <td>{{$transaction->track_id}}</td>
                <td>{{$transaction->ref}}</td>
                <td>{{number_format($transaction->order->total,3)}}</td>
                <td>{{$transaction->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
