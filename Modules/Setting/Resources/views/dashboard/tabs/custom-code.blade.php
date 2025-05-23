

<div id="test-editor" style="width:800px;height:600px;border:1px solid grey"></div>
<a onclick="test()">test</a>
<div class="tab-pane fade" id="custom_code">
    <div class="form-body">
        <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.social_media') }}</h3>
        <div class="col-md-10">

        </div>
    </div>
</div>

@push('start_scripts')

    <script src="{{asset('admin/js/plugins/monaco-editor/min/vs/loader.js')}}"></script>
    <script>
        var container = document.getElementById('test-editor');
        var editor;
        require.config({ paths: { 'vs': '/admin/js/plugins/monaco-editor/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            editor = monaco.editor.create(container, {
                value: [
                    'body{',
                    'color: red;',
                    '}',
                ].join('\n'),
                language: 'css'
            });
            var value = editor.getValue();
            console.log(value);
        });
        function test() {
            var value = editor.getValue();
            console.log(value);
        }
    </script>
@endpush
