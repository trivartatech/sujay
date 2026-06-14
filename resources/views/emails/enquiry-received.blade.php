@component('mail::message')
# New website enquiry

A new enquiry has been submitted through the contact form.

- **Name:** {{ $name }}
@if($email)
- **Email:** {{ $email }}
@endif
@if($phone)
- **Phone:** {{ $phone }}
@endif

Open the dashboard to read the full message and reply.

@component('mail::button', ['url' => $adminUrl])
Open dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
