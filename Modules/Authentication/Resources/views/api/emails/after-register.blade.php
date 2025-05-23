@component('mail::message')

<h2>
 <center>
  {!! __('authentication::api.after-register.mail.header',[
    'email'=>$email,
    'app_name'=>setting('app_name',locale())
    ]) !!}
 </center>
</h2>



@endcomponent


