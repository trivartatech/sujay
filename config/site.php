<?php

/*
|--------------------------------------------------------------------------
| Site / clinic details
|--------------------------------------------------------------------------
| Central place for contact details surfaced across the public site
| (header, footer, contact page, WhatsApp CTA, schema.org markup).
*/

return [
    'name' => env('APP_NAME', 'Dr Sujay J — Cardiac Surgery'),
    'domain' => 'drsujayj.in',

    // tel: link target — full international format, no spaces
    'phone' => env('CLINIC_PHONE', '+917259975826'),
    // Human-readable version shown on the page
    'phone_display' => env('CLINIC_PHONE_DISPLAY', '+91 72599 75826'),

    // wa.me target — country code + number, digits only
    'whatsapp' => env('CLINIC_WHATSAPP', '917259975826'),

    'email' => env('CLINIC_EMAIL', 'contact@drsujayj.in'),
    'address' => env('CLINIC_ADDRESS', ''),

    // Where appointment/enquiry notifications are delivered
    'notification_email' => env('ADMIN_NOTIFICATION_EMAIL', 'admin@drsujayj.in'),
];
