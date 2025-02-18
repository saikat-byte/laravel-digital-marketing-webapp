@component('mail::message')
# Welcome!

Dear {{ $subscriber->name ?? 'Subscriber' }},

Thank you for subscribing to our newsletter!

Please find the attached document for more information.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
