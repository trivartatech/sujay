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
    'specialty' => 'Cardiologist',
    'tagline' => 'Compassionate Care, Advanced Cardiology, Better Heart Health.',
    'domain' => 'drsujayj.in',

    // tel: link target — full international format, no spaces
    'phone' => env('CLINIC_PHONE', '+916361259749'),
    // Human-readable version shown on the page
    'phone_display' => env('CLINIC_PHONE_DISPLAY', '+91 63612 59749'),

    // wa.me target — country code + number, digits only
    'whatsapp' => env('CLINIC_WHATSAPP', '916361259749'),

    'email' => env('CLINIC_EMAIL', 'drsujaycardio@gmail.com'),
    'address' => env('CLINIC_ADDRESS', 'Apollo Hospitals – Sarjapur Road, Bengaluru'),
    'map_url' => env('CLINIC_MAP_URL', 'https://maps.app.goo.gl/JSN6rpwCVkHuu4wAA?g_st=iw'),
    'hours' => env('CLINIC_HOURS', '10:00 AM – 5:00 PM'),

    // Where appointment/enquiry notifications are delivered
    'notification_email' => env('ADMIN_NOTIFICATION_EMAIL', 'drsujaycardio@gmail.com'),

    /*
    |--------------------------------------------------------------------------
    | Analytics
    |--------------------------------------------------------------------------
    | GA4 only loads after the visitor accepts cookies (see partials/consent).
    | Leave blank to disable analytics entirely.
    */
    'ga_id' => env('GA_MEASUREMENT_ID', ''),
    'google_site_verification' => env('GOOGLE_SITE_VERIFICATION', ''),

    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    | Locale comes from the URL prefix (/kn/faqs); English keeps the bare URLs.
    | Missing strings and untranslated content fall back to English.
    */
    'locales' => [
        'en' => 'English',
        'kn' => 'ಕನ್ನಡ',
        'hi' => 'हिन्दी',
        'bn' => 'বাংলা',
        'te' => 'తెలుగు',
        'ml' => 'മലയാളം',
        'or' => 'ଓଡ଼ିଆ',
    ],

    /*
    | Per-language editing in the admin panel. Off by default, so the content
    | screens stay single-language until the clinic is ready to translate.
    |
    | Turning this off only hides the admin UI — it does not touch stored
    | translations, and the public site keeps serving any that already exist.
    | Enable with CONTENT_TRANSLATIONS_ENABLED=true in .env.
    */
    'content_translations' => filter_var(
        env('CONTENT_TRANSLATIONS_ENABLED', false),
        FILTER_VALIDATE_BOOLEAN
    ),

    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK', ''),
        'instagram' => env('SOCIAL_INSTAGRAM', ''),
        'linkedin' => env('SOCIAL_LINKEDIN', ''),
        'youtube' => env('SOCIAL_YOUTUBE', ''),
    ],
];
