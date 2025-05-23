{{-- DATATABLE FILTER --}}
<div class="row">
    <div class="portlet box grey-cascade">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>
                {{__('apps::dashboard.datatable.search')}}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div id="filter_data_table">
                <div class="panel-body">
                    <form id="formFilter" class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            {{__('apps::dashboard.datatable.form.date_range')}}
                                        </label>
                                        <div id="reportrange" class="btn default form-control">
                                            <i class="fa fa-calendar"></i> &nbsp;
                                            <span> </span>
                                            <b class="fa fa-angle-down"></b>
                                            <input type="hidden" name="from">
                                            <input type="hidden" name="to">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            {{__('apps::dashboard.datatable.form.soft_deleted')}}
                                        </label>
                                        <div class="mt-radio-list">
                                            <label class="mt-radio">
                                                {{__('apps::dashboard.datatable.form.delete_only')}}
                                                <input type="radio" value="only"
                                                       name="deleted"/>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            {{__('apps::dashboard.datatable.form.status')}}
                                        </label>
                                        <div class="mt-radio-list">
                                            <label class="mt-radio">
                                                {{__('apps::dashboard.datatable.form.active')}}
                                                <input type="radio" value="1" name="status"/>
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                {{__('apps::dashboard.datatable.form.unactive')}}
                                                <input type="radio" value="0" name="status"/>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                @yield('filter')
                            </div>
                        </div>
                    </form>
                    <div class="form-actions">
                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                id="search">
                            <i class="fa fa-search"></i>
                            {{__('apps::dashboard.datatable.search')}}
                        </button>
                        <button class="btn btn-sm red btn-outline filter-cancel">
                            <i class="fa fa-times"></i>
                            {{__('apps::dashboard.datatable.reset')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- END DATATABLE FILTER --}}