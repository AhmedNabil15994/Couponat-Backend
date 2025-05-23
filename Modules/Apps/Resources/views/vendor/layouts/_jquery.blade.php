
<!--[if lt IE 9]>
<script src="{{asset('/admin/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('/admin/assets/global/plugins/excanvas.min.js')}}"></script>
<script src="{{asset('/admin/assets/global/plugins/ie8.fix.min.js')}}"></script>
<![endif]-->
<script src="{{asset('/admin/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('/admin/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/pages/scripts/portfolio-1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin/assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>

<script src="{{asset('ckeditor5/js/ckeditor.js')}}"></script>
<script src="{{asset('ckeditor5/js/ckEditorScripts.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('/admin/js/actions.js')}}" type="text/javascript"></script>
{{-- <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.5/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>
<script src="{{ url('admin/assets/global/plugins/jquery-nestable/jquery.nestable.js') }}"></script>
{{-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> --}}
<script src="{{asset('/admin/js/customtiny.js')}}" type="text/javascript"></script>
@stack('start_scripts')
@yield('scripts')
<script>
    @if($errors->all())
        @foreach($errors->all() as $error)
        toastr["error"]("{{$error}}");
        @endforeach
    @endif

    @if(session('msg'))
    toastr['success']("{{session('msg')}}")
    @endif
  // DELETE ROW FROM DATATABLE
  function deleteRow(url)
  {
    var _token  = $('input[name=_token]').val();

    bootbox.confirm({
      message: '{{__('apps::vendor.messages.delete')}}',
      buttons: {
        confirm: {
          label: '{{__('apps::vendor.buttons.yes')}}',
          className: 'btn-success'
        },
        cancel: {
          label: '{{__('apps::vendor.buttons.no')}}',
          className: 'btn-danger'
        }
      },

      callback: function (result) {
        if(result){

          $.ajax({
            method  : 'DELETE',
            url     : url,
            data    : {
              _token  : _token
            },
            success: function(msg) {
              toastr["success"](msg[1]);
              $('#dataTable').DataTable().ajax.reload();
            },
            error: function( msg ) {
              toastr["error"](msg[1]);
              $('#dataTable').DataTable().ajax.reload();
            }
          });

        }
      }
    });
  }

  // DELETE ROW FROM DATATABLE
  function deleteAllChecked(url)
  {
    var someObj = {};
    someObj.fruitsGranted = [];

    $("input:checkbox").each(function(){
      var $this = $(this);

      if($this.is(":checked")){
        someObj.fruitsGranted.push($this.attr("value"));
      }
    });

    var ids = someObj.fruitsGranted;

    bootbox.confirm({
      message: '{{__('apps::vendor.messages.delete_all')}}',
      buttons: {
        confirm: {
          label: '{{__('apps::vendor.buttons.yes')}}',
          className: 'btn-success'
        },
        cancel: {
          label: '{{__('apps::vendor.buttons.no')}}',
          className: 'btn-danger'
        }
      },

      callback: function (result) {
        if(result){

          $.ajax({
            type    : "GET",
            url     : url,
            data    : {
              ids     : ids,
            },
            success: function(msg) {

              if (msg[0] == true){
                toastr["success"](msg[1]);
                $('#dataTable').DataTable().ajax.reload();
              }
              else{
                toastr["error"](msg[1]);
              }

            },
            error: function( msg ) {
              toastr["error"](msg[1]);
              $('#dataTable').DataTable().ajax.reload();
            }
          });

        }
      }
    });
  }
</script>
