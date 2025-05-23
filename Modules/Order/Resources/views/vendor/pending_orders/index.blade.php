@extends('apps::vendor.layouts.app')
@section('title', __('order::vendor.orders.index.title'))
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
                    <a href="#">{{__('order::vendor.orders.index.title')}}</a>
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
                                                                {{__('order::vendor.orders.datatable.email')}}
                                                            </label>
                                                            <input type="email" name="email" placeholder="{{__('order::vendor.orders.datatable.email')}}" value="{{old('email')}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{__('order::vendor.orders.datatable.mobile')}}
                                                            </label>
                                                            <input type="text" name="mobile" placeholder="{{__('order::vendor.orders.datatable.mobile')}}" value="{{old('mobile')}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="item_code" value="{{request()->get('item_code')}}">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{__('order::vendor.orders.datatable.offers')}}
                                                            </label>
                                                            <select name="offer_id"
                                                                    id="single"
                                                                    class="form-control select2">
                                                                <option value="">
                                                                    {{__('apps::vendor.datatable.form.select')}}
                                                                </option>
                                                                @inject('offers','Modules\Offer\Entities\Offer')
                                                                @foreach ($offers->where('seller_id',auth()->id())->get() as $offer)
                                                                    <option value="{{ $offer['id'] }}"
                                                                            @if(request('offer_id')==$offer['id'])
                                                                                selected
                                                                        @endif>
                                                                        {{ $offer->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
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
                                {{__('order::vendor.orders.index.title')}}
                            </span>
                        </div>
                    </div>

                    {{-- DATATABLE CONTENT --}}
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover"
                            id="dataTable">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="javascript:;"
                                            onclick="CheckAll()">
                                            {{__('apps::vendor.buttons.select_all')}}
                                        </a>
                                    </th>
                                    <th>#</th>
                                    <th>{{__('order::vendor.orders.datatable.user')}}</th>
                                    <th>{{__('order::vendor.orders.datatable.mobile')}}</th>
                                    <th>{{__('order::vendor.orders.datatable.email')}}</th>
                                    <th>{{__('order::vendor.orders.datatable.total')}}</th>
                                    <th>{{__('order::vendor.orders.datatable.status')}}</th>
                                    <th>{{__('order::vendor.orders.datatable.created_at')}}</th>
                                    <th>{{__('order::vendor.orders.datatable.options')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @can('delete_bulk_orders')
                    <div class="row">
                        <div class="form-group">
                            <button type="submit"
                                id="deleteChecked"
                                class="btn red btn-sm"
                                onclick="deleteAllChecked('{{ url(route('vendor.orders.deletes')) }}')">
                                {{__('apps::vendor.datatable.delete_all_btn')}}
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')

<script>
    function tableGenerate(data = '') {

        var dataTable =
            $('#dataTable').DataTable({
                ajax: {
                    url: "{{ url(route('vendor.orders.datatable')) }}?order_status_id=3&item_code="+'{{request()->get('item_code')}}',
                    type: "GET",
                    data: {
                        req: data,
                    },
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                },
                stateSave: true,
                processing: true,
                serverSide: true,
                responsive: !0,
                order: [
                    [1, "desc"]
                ],
                columns: [
                    {
                        data: 'id',className: 'dt-center'
                    },
                    {
                        data: 'id',className: 'dt-center'
                    },
                    {
                        data: 'username',className: 'dt-center'
                    },
                    {
                        data: 'mobile',className: 'dt-center'
                    },
                    {
                        data: 'email',className: 'dt-center'
                    },
                    {
                        data: 'total',className: 'dt-center'
                    },
                    {
                        data: 'order_status_id',className: 'dt-center'
                    },
                    {
                        data: 'created_at',className: 'dt-center'
                    },
                    {
                        data: 'id',responsivePriority: 1
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '30px',
                        className: 'dt-center',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                          <input type="checkbox" value="` + data + ` class="group-checkable" name="ids">
                          <span></span>
                        </label>
                      `;
                        },
                    },
                    {
                        targets: -1,
responsivePriority:1,
                        width: '13%',
                        title: '{{__('order::vendor.orders.datatable.options')}}',
                        className: 'dt-center',
                        orderable: false,
                        render: function(data, type, full, meta) {

                            // Show
                            var showUrl = '{{ route("vendor.orders.show", ":id") }}';
                            showUrl = showUrl.replace(':id', data);

                            return `
                            @can('show_orders')
          						<a href="` + showUrl + `" class="btn btn-sm btn-warning" title="Show">
          			              <i class="fa fa-eye"></i>
          			            </a>
		                    @endcan`;

                        },
                    },
                ],
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, 100, 500],
                    ['10', '25', '50', '100', '500']
                ],
                buttons: [{
                        extend: "pageLength",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::vendor.datatable.pageLength')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "print",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::vendor.datatable.print')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "pdf",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::vendor.datatable.pdf')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "excel",
                        className: "btn blue btn-outline ",
                        text: "{{__('apps::vendor.datatable.excel')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "colvis",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::vendor.datatable.colvis')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                ]
            });
    }

    jQuery(document).ready(function() {
      let trainer_id = "{{request('trainer_id')}}";
      if(trainer_id != ''){
        $('#dataTable').DataTable().destroy();
        $('.filter-submit').click()
      }else{
        tableGenerate();
      }
    });
</script>

@stop
