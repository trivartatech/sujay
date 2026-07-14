<?php

/*
|--------------------------------------------------------------------------
| Site / clinic details
|--------------------------------------------------------------------------
| Central place for branding and contact details surfaced across the public
| site (top bar, header, footer, contact page, WhatsApp CTA, schema.org).
*/

return [
    'name' => 'Dr. Sujay J',
    'specialty' => 'Cardiologist & Pulmonologist',
    'tagline' => 'Compassionate Care, Advanced Cardiology, Better Heart Health.',
    'domain' => 'drsujayj.in',

    // tel: link target — full international format, no spaces
    'phone' => env('CLINIC_PHONE', '+917259975826'),
    // Human-readable version shown on the page
    'phone_display' => env('CLINIC_PHONE_DISPLAY', '+91 72599 75826'),

    // wa.me target — country code + number, digits only
    'whatsapp' => env('CLINIC_WHATSAPP', '917259975826'),

    'email' => env('CLINIC_EMAIL', 'drsujaycardio@gmail.com'),
    'address' => env('CLINIC_ADDRESS', 'Apollo Hospitals – Sarjapur Road, Bengaluru'),
    'map_url' => env('CLINIC_MAP_URL', 'https://maps.app.goo.gl/JSN6rpwCVkHuu4wAA?g_st=iw'),
    'hours' => env('CLINIC_HOURS', '10:00 AM – 5:00 PM'),

    // Where appointment/enquiry notifications are delivered
    'notification_email' => env('ADMIN_NOTIFICATION_EMAIL', 'drsujaycardio@gmail.com'),

    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK', ''),
        'instagram' => env('SOCIAL_INSTAGRAM', ''),
        'linkedin' => env('SOCIAL_LINKEDIN', ''),
        'youtube' => env('SOCIAL_YOUTUBE', ''),
    ],
];
