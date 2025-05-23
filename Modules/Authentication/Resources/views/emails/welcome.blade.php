@component('mail::message')

<h2>
  <center> {{ setting('app_name',locale() .' '.__('Welcomes you')) }} </center>
</h2>


@component('mail::button', ['url' => url(route('frontend.home'))])
<center> {{ setting('app_name',locale() .' '.__('Welcomes you')) }} </center>

{{ __('Browse now') .' '.setting('app_name',locale()) }}

@endcomponent
@endcomponent
