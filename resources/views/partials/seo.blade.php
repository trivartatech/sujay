@php
    // yieldContent returns the section content already HTML-escaped (Blade's
    // inline @section escapes it), so decode first to avoid double-encoding
    // (e.g. "&" becoming "&amp;amp;") when {{ }} escapes again below.
    $siteName = config('site.name').' — '.config('site.specialty');
    $t = trim(html_entity_decode($__env->yieldContent('title'), ENT_QUOTES));
    $pageTitle = $t !== '' ? $t.' — '.config('site.name') : $siteName;
    $d = trim(html_entity_decode($__env->yieldContent('description'), ENT_QUOTES));
    $desc = $d !== '' ? $d : 'Consultant Cardiologist providing compassionate, evidence-based care for your heart health.';
@endphp
<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $desc }}">
<link rel="canonical" href="{{ url()->current() }}">

{{-- hreflang — tells Google these are translations of one page, not duplicates --}}
@php($alternates = \App\Support\Locale::switcherEnabled() ? \App\Support\Locale::alternates() : [])
@if(count($alternates) > 1)
    @foreach($alternates as $altLocale => $altUrl)
        <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ $altUrl }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ $alternates['en'] ?? url()->current() }}">
@endif

{{-- Open Graph / social --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $desc }}">
<meta property="og:url" content="{{ url()->current() }}">
@stack('og')
<meta name="twitter:card" content="summary_large_image">
