@component('mail::message')
{!!  __('order::frontend.emails.successfully_booked_start') !!}@foreach($courses as $course){{optional($course->course->title}} ,@endforeach{!! __('order::frontend.emails.successfully_booked_end')!!}

{{__('apps::frontend.emails.thanks')}},<br>{{ config('app.name') }}
@endcomponent
