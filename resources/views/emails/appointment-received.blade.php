@component('mail::message')
# New appointment request

A new appointment request has been submitted through the website.

- **Name:** {{ $name }}
- **Phone:** {{ $phone }}
@if($preferredDate)
- **Preferred date:** {{ $preferredDate }}
@endif
@if($preferredTime)
- **Preferred time:** {{ $preferredTime }}
@endif

The reason for visit and full details are available in the dashboard.

@component('mail::button', ['url' => $adminUrl])
Open dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
