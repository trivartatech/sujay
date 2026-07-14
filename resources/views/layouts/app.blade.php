<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.seo')

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

            // Self-drawing ECG lines + gentle heartbeat on decorative hearts
            document.querySelectorAll('.hero__ecg').forEach(function (el) { el.classList.add('ecg-draw'); });
            document.querySelectorAll('.commit-card__art img, .heart-divider svg, .philosophy-heart').forEach(function (el) { el.classList.add('beat'); });

            // Scroll-based reveal (reliable everywhere; reveals what's in view, incl. on load)
            var pending = reveals.concat(Array.prototype.slice.call(document.querySelectorAll('.ecg-draw')));
            function revealVisible() {
                var vh = window.innerHeight || document.documentElement.clientHeight;
                pending = pending.filter(function (el) {
                    var r = el.getBoundingClientRect();
                    if (r.top < vh * 0.92 && r.bottom > 0) { el.classList.add('in-view'); return false; }
                    return true;
                });
            }
            var ticking = false;
            function onScroll() { if (!ticking) { ticking = true; requestAnimationFrame(function () { revealVisible(); ticking = false; }); } }
            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onScroll);
            requestAnimationFrame(revealVisible);   // initial pass (above-the-fold)
            setTimeout(revealVisible, 400);          // safety net
            // Absolute fallback: never leave anything hidden
            setTimeout(function () { pending.forEach(function (el) { el.classList.add('in-view'); }); }, 2500);
        })();
    </script>
    @stack('scripts')
</body>
</html>
