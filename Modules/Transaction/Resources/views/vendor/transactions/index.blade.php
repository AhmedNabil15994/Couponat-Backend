@extends('apps::vendor.layouts.app')
@section('title', __('transaction::vendor.transactions.index.title'))
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
                    <a href="#">{{__('transaction::vendor.transactions.index.title')}}</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">


                    {{-- DATATABLE FILTER --}}
                    <div class="row">
                        <div class="portlet box grey-cascade">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>
                                    {{__('apps::vendor.datatable.search')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:;"
                                        class="collapse"
                                        data-original-title=""
                                        title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="filter_data_table">
                                    <div class="panel-body">
                                        <form id="formFilter"
                                            class="horizontal-form">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{__('apps::vendor.datatable.form.date_range')}}
                                                            </label>
                                                            <div id="reportrange"
                                                                class="btn default form-control">
                                                                <i class="fa fa-calendar"></i> &nbsp;
                                                                <span> </span>
                                                                <b class="fa fa-angle-down"></b>
                                                                <input type="hidden"
                                                                    name="from">
                                                                <input type="hidden"
                                                                    name="to">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{__('apps::vendor.datatable.form.soft_deleted')}}
                                                            </label>
                                                            <div class="mt-radio-list">
                                                                <label class="mt-radio">
                                                                    {{__('apps::vendor.datatable.form.delete_only')}}
                                                                    <input type="radio"
                                                                        value="only"
                                                                        name="deleted" />
                                                                    <span></span>
                                                                </label>
                                                                <label class="mt-radio">
                                                                    {{__('apps::vendor.datatable.form.with_deleted')}}
                                                                    <input type="radio"
                                                                        value="with"
                                                                        name="deleted" />
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="form-actions">
                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                id="search">
                                                <i class="fa fa-search"></i>
                                                {{__('apps::vendor.datatable.search')}}
                                            </button>
                                            <button class="btn btn-sm red btn-outline filter-cancel">
                                                <i class="fa fa-times"></i>
                                                {{__('apps::vendor.datatable.reset')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END DATATABLE FILTER --}}



                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">
                                {{__('transaction::vendor.transactions.index.title')}}
                            </span>
                        </div>
                    </div>

                    {{-- DATATABLE CONTENT --}}
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover"
                            id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('transaction::vendor.transactions.datatable.payment_id')}}</th>
                                    <th>{{__('transaction::vendor.transactions.datatable.method')}}</th>
                                    <th>{{__('transaction::vendor.transactions.datatable.result')}}</th>
                                    <th>{{__('transaction::vendor.transactions.datatable.track_id')}}</th>
                                    <th>{{__('transaction::vendor.transactions.datatable.type')}}</th>
                                    <th>{{__('transaction::vendor.transactions.datatable.ref')}}</th>
                                    <th>{{__('order::vendor.orders.datatable.total')}}</th>
                                    <th>{{__('transaction::vendor.transactions.datatable.created_at')}}</th>
                                    <th>{{__('transaction::vendor.transactions.datatable.options')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')

<script>
    function tableGenerate(data='') {

      var dataTable =
      $('#dataTable').DataTable({
          ajax : {
              url   : "{{ url(route('vendor.transactions.datatable')) }}",
              type  : "GET",
              data  : {
                  req : data,
              },
          },
          language: {
              url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
          },
          stateSave: true,
          processing: true,
          serverSide: true,
          responsive: !0,
          order     : [[ 0 , "desc" ]],
          columns: [
      			{data: 'id' 		 	        , className: 'dt-center'},
            {data: 'payment_id' 			, className: 'dt-center'},
            {data: 'method' 			    , className: 'dt-center'},
            {data: 'result' 			    , className: 'dt-center'},
            {data: 'track_id' 			  , className: 'dt-center'},
            {data: 'type' 			      , className: 'dt-center' , orderable: false},
            {data: 'ref' 			        , className: 'dt-center'},
            {data: 'total' 			        , className: 'dt-center'},
            {data: 'created_at' 		  , className: 'dt-center'},
            {data: 'id',responsivePriority: 1},
      		],
          columnDefs: [
            {
              targets: -1,
responsivePriority:1,
              width: '13%',
              title: '{{__('transaction::vendor.transactions.datatable.options')}}',
              className: 'dt-center',
              orderable: false,
              render: function(data, type, full, meta) {
      					return ``;
              },
            },
          ],
          dom: 'Bfrtip',
          lengthMenu: [
              [ 10, 25, 50 , 100 , 500 ],
              [ '10', '25', '50', '100' , '500']
          ],
  				buttons:[
  					{
  						extend: "pageLength",
              className: "btn blue btn-outline",
              text: "{{__('apps::vendor.datatable.pageLength')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 ,5 ,6 ,7]
                }
  					},
  					{
  						extend: "print",
              className: "btn blue btn-outline" ,
              text: "{{__('apps::vendor.datatable.print')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 ,5 ,6 ,7]
                }
  					},
  					{
  							extend: "pdf",
                className: "btn blue btn-outline" ,
                text: "{{__('apps::vendor.datatable.pdf')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 ,5 ,6 ,7]
                }
  					},
  					{
  							extend: "excel",
                className: "btn blue btn-outline " ,
                text: "{{__('apps::vendor.datatable.excel')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 ,5 ,6 ,7]
                }
  					},
  					{
  							extend: "colvis",
                className: "btn blue btn-outline",
                text: "{{__('apps::vendor.datatable.colvis')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 ,5 ,6 ,7]
                }
  					}
  				]
      });
  }

  jQuery(document).ready(function() {
  	tableGenerate();
  });
</script>

@stop
