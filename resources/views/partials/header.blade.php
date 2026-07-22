<header class="site-header">
    <div class="container nav">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/logo-mark.png') }}?v={{ @filemtime(public_path('images/logo-mark.png')) ?: '1' }}" alt="" class="brand__mark">
            <img src="{{ asset('images/logo-text.png') }}?v={{ @filemtime(public_path('images/logo-text.png')) ?: '1' }}" alt="{{ config('site.name') }} — {{ config('site.specialty') }}" class="brand__wordmark">
        </a>

        @php
            $locales = config('site.locales', []);
            $alternates = \App\Support\Locale::alternates();
        @endphp

        <ul class="nav__links">
            <li><a href="{{ route('home') }}">{{ __('site.nav_home') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('site.nav_meet') }}</a></li>
            <li><a href="{{ route('philosophy') }}">{{ __('site.nav_philosophy') }}</a></li>
            <li><a href="{{ route('services.index') }}">{{ __('site.nav_services') }}</a></li>

            <li class="has-drop">
                <a href="{{ route('library.index') }}">{{ __('site.nav_library') }}</a>
                @if(!empty($navSections) && $navSections->isNotEmpty())
                    <ul class="drop">
                        @foreach($navSections as $navSection)
                            <li><a href="{{ route('library.section', $navSection) }}">{{ $navSection->title }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>

            <li><a href="{{ route('blog.index') }}">{{ __('site.nav_blog') }}</a></li>
            <li><a href="{{ route('faqs') }}">{{ __('site.nav_faqs') }}</a></li>

            <li>
                <a href="{{ route('appointment.create') }}" class="btn btn--primary">
                    <x-ui-icon name="calendar" style="width:16px;height:16px" />
                    {{ __('site.request_consultation') }}
                </a>
            </li>
        </ul>

        {{-- Sits in the header bar on every screen size, never inside the
             hamburger. Without JS the select is a plain GET — ?lang=xx 301s to
             the prefixed URL; with JS it jumps straight to the translated page. --}}
        @php($showLanguagePicker = \App\Support\Locale::switcherEnabled() && count($alternates) > 1)

        {{-- With no picker this holds only the hamburger, which desktop hides —
             the modifier collapses the empty box so the CTA keeps the right edge. --}}
        <div class="nav__utility @unless($showLanguagePicker) nav__utility--toggle-only @endunless">
            @if($showLanguagePicker)
                <form class="lang-select" method="GET" action="">
                    <x-ui-icon name="globe" aria-hidden="true" />
                    <label class="sr-only" for="langSelect">{{ __('site.language') }}</label>
                    <select id="langSelect" name="lang" data-lang-select>
                        @foreach($alternates as $code => $url)
                            <option value="{{ $code }}" data-url="{{ $url }}" @selected($code === app()->getLocale())>{{ $locales[$code] ?? $code }}</option>
                        @endforeach
                    </select>
                    <noscript><button type="submit" class="lang-select__go">&rarr;</button></noscript>
                </form>
            @endif

            <button class="nav__toggle" aria-label="Toggle menu">&#9776;</button>
        </div>
    </div>
</header>
