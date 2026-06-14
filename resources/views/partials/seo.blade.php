@php
    $t = trim($__env->yieldContent('title'));
    $pageTitle = $t !== '' ? $t.' — '.config('site.name') : config('site.name');
    $d = trim($__env->yieldContent('description'));
    $desc = $d !== '' ? $d : 'Experienced cardiac & cardiothoracic surgeon — CABG, valve replacement, angioplasty, and pediatric cardiac surgery.';
@endphp
<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $desc }}">
<link rel="canonical" href="{{ url()->current() }}">

{{-- Open Graph / social --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('site.name') }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $desc }}">
<meta property="og:url" content="{{ url()->current() }}">
@stack('og')
<meta name="twitter:card" content="summary_large_image">
