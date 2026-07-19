<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.seo')

    @if(config('site.google_site_verification'))
        <meta name="google-site-verification" content="{{ config('site.google_site_verification') }}">
    @endif

    <link rel="icon" href="{{ asset('favicon.png') }}?v={{ @filemtime(public_path('favicon.png')) ?: '1' }}" sizes="128x128" type="image/png">
    <link rel="icon" href="{{ asset('favicon-32.png') }}?v={{ @filemtime(public_path('favicon-32.png')) ?: '1' }}" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    @php $cssPath = public_path('css/app.css'); @endphp
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ is_file($cssPath) ? filemtime($cssPath) : '1' }}">

    {{-- Physician schema on every page --}}
    <script type="application/ld+json">
    {!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Physician',
        'name' => config('site.name'),
        'medicalSpecialty' => 'Cardiovascular',
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
    @include('partials.consent')

    <a class="wa-float" href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
        <x-ui-icon name="whatsapp" style="width:28px;height:28px" />
    </a>

    <script>
        document.querySelector('.nav__toggle')?.addEventListener('click', function () {
            document.querySelector('.nav__links')?.classList.toggle('is-open');
        });
    </script>

    {{-- Subtle scroll-reveal + heartbeat/ECG motion (fail-safe: only hides when JS + no reduced-motion) --}}
    <script>
        (function () {
            var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (reduce || !('IntersectionObserver' in window)) return;
            document.documentElement.classList.add('js-motion');

            var revealSel = '.section__head, .care, .lib-tile, .lib-card, .card, .post-card, .value-card, .trust-card, .edu-node, .stat-item, .expertise-list li, .commit-card, .goal-card, .cta-strip, .quote, .faq, .about-hero__intro, .about-hero__photo, .phil-hero__intro, .phil-hero__media, .hero__points, .hero__cta, .prose, .form';
            var reveals = Array.prototype.slice.call(document.querySelectorAll(revealSel));
            reveals.forEach(function (el) { el.setAttribute('data-reveal', ''); });

            // Stagger items inside rows/grids
            document.querySelectorAll('.grid, .care-grid, .value-grid, .trust-grid, .edu-timeline, .stat-row').forEach(function (row) {
                Array.prototype.slice.call(row.children).forEach(function (ch, i) {
                    if (ch.hasAttribute('data-reveal')) ch.style.setProperty('--reveal-delay', (i * 80) + 'ms');
                });
            });

            // Gentle heartbeat on decorative hearts (hero ECG now scrolls continuously via CSS)
            document.querySelectorAll('.commit-card__art img, .philosophy-card__art img, .heart-divider svg, .philosophy-heart').forEach(function (el) { el.classList.add('beat'); });

            // Scroll-based reveal — reliable in real browsers; uses timers (not
            // rAF, which pauses in hidden tabs) for the initial passes.
            var pending = reveals.concat(Array.prototype.slice.call(document.querySelectorAll('.ecg-draw')));
            function pass() {
                var vh = window.innerHeight || document.documentElement.clientHeight;
                var canScroll = document.documentElement.scrollHeight > vh + 4;
                pending = pending.filter(function (el) {
                    var r = el.getBoundingClientRect();
                    // reveal what's in view; on non-scrollable pages reveal all (no scroll will fire)
                    if (!canScroll || (r.top < vh * 0.92 && r.bottom > 0)) { el.classList.add('in-view'); return false; }
                    return true;
                });
            }
            var ticking = false;
            function onScroll() {
                if (ticking) return; ticking = true;
                (window.requestAnimationFrame || window.setTimeout)(function () { pass(); ticking = false; }, 16);
            }
            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onScroll);
            window.addEventListener('load', pass);
            setTimeout(pass, 100);
            setTimeout(pass, 500);
            setTimeout(pass, 1500);
        })();
    </script>
    @stack('scripts')
</body>
</html>
