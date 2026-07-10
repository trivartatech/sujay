<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.seo')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Physician schema on every page --}}
    <script type="application/ld+json">
    {!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Physician',
        'name' => config('site.name'),
        'medicalSpecialty' => ['Cardiovascular', 'Pulmonary'],
        'url' => config('app.url'),
        'telephone' => config('site.phone'),
        'email' => config('site.email'),
        'address' => config('site.address') ?: null,
    ]), JSON_UNESCAPED_SLASHES) !!}
    </script>

    @stack('head')
</head>
<body>
    @include('partials.topbar')
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <a class="wa-float" href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
        <x-ui-icon name="whatsapp" style="width:28px;height:28px" />
    </a>

    <script>
        document.querySelector('.nav__toggle')?.addEventListener('click', function () {
            document.querySelector('.nav__links')?.classList.toggle('is-open');
        });
    </script>
    @stack('scripts')
</body>
</html>
