<header class="site-header">
    <div class="container nav">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/logo-mark.png') }}?v={{ @filemtime(public_path('images/logo-mark.png')) ?: '1' }}" alt="" class="brand__mark">
            <img src="{{ asset('images/logo-text.png') }}?v={{ @filemtime(public_path('images/logo-text.png')) ?: '1' }}" alt="{{ config('site.name') }} — {{ config('site.specialty') }}" class="brand__wordmark">
        </a>

        <button class="nav__toggle" aria-label="Toggle menu">&#9776;</button>

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

            @php
                $locales = config('site.locales', []);
                $alternates = \App\Support\Locale::alternates();
            @endphp
            @if(count($alternates) > 1)
                <li class="has-drop lang-switch">
                    <a href="#" aria-label="{{ __('site.language') }}">
                        <x-ui-icon name="globe" style="width:15px;height:15px" />
                        {{ $locales[app()->getLocale()] ?? 'English' }}
                    </a>
                    <ul class="drop">
                        @foreach($alternates as $code => $url)
                            <li>
                                <a href="{{ $url }}" hreflang="{{ $code }}"
                                   @if($code === app()->getLocale()) aria-current="true" @endif>{{ $locales[$code] ?? $code }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif

            <li>
                <a href="{{ route('appointment.create') }}" class="btn btn--primary">
                    <x-ui-icon name="calendar" style="width:16px;height:16px" />
                    {{ __('site.request_consultation') }}
                </a>
            </li>
        </ul>
    </div>
</header>
