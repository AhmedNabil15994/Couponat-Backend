

{!! field()->langNavTabs() !!}
<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('notification::dashboard.notifications.form.msg_title').'-'.$code ,
                    null,
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->textarea('body['.$code.']',
            __('notification::dashboard.notifications.form.msg_body').'-'.$code ,
                    null,
                  ['data-name' => 'body.'.$code,"rows"=>"10" ,"cols"=>"30","class"=>"form-control"]
             ) !!}
        </div>
    @endforeach
        {!! field()->dateTime('send_at',__('notification::dashboard.notifications.form.send_at'),null,['data-name' => 'send_at',
//                         'min'  => date('Y-m-d H:i')
                         ]
                         ) !!}
</div>








