@extends('layouts.app')

@section('description', 'Dr. Sujay J — Consultant Cardiologist. Compassionate, evidence-based care for your heart health.')

@section('content')

    {{-- ── Hero ───────────────────────────────────────────── --}}
    <section class="hero">
        <div class="container hero__grid">
            <div>
                <h1>{{ __('site.hero_title_1') }}<br>{{ __('site.hero_title_2') }} <span class="accent beat-text">{{ __('site.hero_accent') }}</span></h1>
                <p class="hero__lead">{{ __('site.hero_lead') }}</p>

                <div class="hero__points">
                    <span class="hero__point"><x-ui-icon name="heart-pulse" /> {{ __('site.point_personalized') }}</span>
                    <span class="hero__point"><x-ui-icon name="check-circle" /> {{ __('site.point_diagnostics') }}</span>
                    <span class="hero__point"><x-ui-icon name="users" /> {{ __('site.point_preventive') }}</span>
                </div>

                <div class="hero__cta">
                    <a href="{{ route('appointment.create') }}" class="btn btn--primary">{{ __('site.book_appointment') }}</a>
                    <a href="{{ route('library.index') }}" class="btn btn--outline">{{ __('site.explore_library') }}</a>
                </div>
            </div>

            <div class="hero__media">
                <img src="{{ asset('images/dr-sujay-hero.jpg') }}?v={{ @filemtime(public_path('images/dr-sujay-hero.jpg')) ?: '1' }}"
                     alt="{{ config('site.name') }}, Consultant {{ config('site.specialty') }}"
                     class="hero__photo" width="400" height="436" fetchpriority="high">
            </div>
        </div>

        @php $ecgSeg = 'h60 l8 -4 l8 4 h10 l6 4 l6 -26 l6 34 l6 -12 h10 l12 -7 l12 7 h56 '; @endphp
        <div class="hero__ecg" aria-hidden="true">
            <svg viewBox="0 0 1200 48" preserveAspectRatio="none">
                <defs>
                    <mask id="ecgGap" maskUnits="userSpaceOnUse" x="0" y="0" width="1200" height="48">
                        <rect width="1200" height="48" fill="#fff"/>
                        {{-- blank "refresh" window just ahead of the sweep cursor --}}
                        <rect class="ecg-cursor" x="0" y="0" width="90" height="48" fill="#000"/>
                    </mask>
                </defs>
                <path class="ecg-trace" d="M0 28 {{ str_repeat($ecgSeg, 7) }}" fill="none" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" mask="url(#ecgGap)"/>
                {{-- glowing sweep cursor at the leading edge --}}
                <rect class="ecg-cursor ecg-cursor-bar" x="-1.4" y="6" width="2.8" height="36" rx="1.4"/>
            </svg>
        </div>
    </section>

    {{-- ── Comprehensive Cardiac Care ──────────────────────── --}}
    @if($services->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="section__head" style="margin-bottom:1.75rem">
                    <h2>{{ __('site.care_title') }}</h2>
                </div>

                <div class="care-grid">
                    @foreach($services as $service)
                        <a class="care" href="{{ route('services.show', $service) }}">
                            <span class="care__icon">
                                @if($service->care_icon_url)
                                    <img src="{{ $service->care_icon_url }}" alt="{{ $service->title }}" loading="lazy">
                                @else
                                    <x-ui-icon :name="$service->icon ?: 'heart-pulse'" />
                                @endif
                            </span>
                            <h3>{{ $service->title }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ── Heart Health Library ────────────────────────────── --}}
    @if($sections->isNotEmpty())
        <section class="section section--soft">
            <div class="container container--wide">
                <div class="section__head">
                    <h2>{{ __('site.library_title') }}</h2>
                    <p>{{ __('site.library_sub') }}</p>
                </div>

                <div class="grid grid--6">
                    @foreach($sections as $section)
                        @if($section->card_image_url)
                            <a class="lib-tile" href="{{ route('library.section', $section) }}">
                                <img class="lib-tile__img" src="{{ $section->card_image_url }}" alt="{{ $section->title }}" loading="lazy">
                                <div class="lib-tile__cap">
                                    @unless($section->image_has_title)<h3>{{ $section->title }}</h3>@endunless
                                    <p>{{ \Illuminate\Support\Str::limit($section->description, 48) }}</p>
                                </div>
                            </a>
                        @else
                            <a class="lib-card" href="{{ route('library.section', $section) }}">
                                <div class="lib-card__img lib-card__img--ph"><x-ui-icon name="book" style="width:34px;height:34px" /></div>
                                <div class="lib-card__body">
                                    <h3>{{ $section->title }}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit($section->description, 48) }}</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ── Why choose Dr. Sujay J ──────────────────────────── --}}
    <section class="section">
        <div class="container split">
            <div>
                <div class="hero__heart">
                    <img src="{{ asset('images/philosophy-heart.png') }}?v={{ @filemtime(public_path('images/philosophy-heart.png')) ?: '1' }}" alt="Anatomical heart" class="beat">
                </div>
            </div>
            <div>
                <span class="eyebrow">{{ __('site.why_eyebrow') }}</span>
                <h2>{{ __('site.why_title') }}</h2>
                <p>{{ __('site.why_lead') }}</p>

                <ul class="list-check">
                    <li>{{ __('site.why_point_1') }}</li>
                    <li>{{ __('site.why_point_2') }}</li>
                    <li>{{ __('site.why_point_3') }}</li>
                </ul>

                <a href="{{ route('about') }}" class="btn btn--primary">{{ __('site.know_more_about_me') }}</a>
            </div>
        </div>
    </section>

    {{-- ── Featured Blog & Research ────────────────────────── --}}
    @if($posts->isNotEmpty())
        <section class="section section--soft">
            <div class="container">
                <div class="section__head">
                    <h2>{{ __('site.blog_title') }}</h2>
                </div>

                <div class="grid grid--3">
                    @foreach($posts->take(3) as $post)
                        <a class="post-card" href="{{ route('blog.show', $post) }}">
                            @if($post->featured_image)
                                <img class="post-card__img" src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
                            @else
                                <span class="post-card__img post-card__img--logo">
                                    <img src="{{ asset('images/logo-mark.png') }}" alt="{{ config('site.name') }}" loading="lazy">
                                </span>
                            @endif
                            <span>
                                <h3>{{ \Illuminate\Support\Str::limit($post->title, 46) }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->body), 52) }}</p>
                                <span class="stars">★★★★★</span>
                            </span>
                        </a>
                    @endforeach
                </div>

                <p style="text-align:center;margin-top:2rem">
                    <a href="{{ route('blog.index') }}" class="btn btn--outline">{{ __('site.view_all_articles') }}</a>
                </p>
            </div>
        </section>
    @endif

    {{-- ── Testimonials ────────────────────────────────────── --}}
    @if($testimonials->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="section__head">
                    <h2>{{ __('site.testimonials_title') }}</h2>
                </div>
                <div class="grid grid--3">
                    @foreach($testimonials as $testimonial)
                        <figure class="quote" style="margin:0">
                            @if($testimonial->rating)
                                <div class="stars">{{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }}</div>
                            @endif
                            <p>“{{ $testimonial->content }}”</p>
                            <cite>— {{ $testimonial->patient_name }}</cite>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ── CTA band ────────────────────────────────────────── --}}
    <section class="page-band" style="text-align:center">
        <div class="container">
            <h1 style="font-size:clamp(1.5rem,3vw,2.1rem)">{{ __('site.cta_title') }}</h1>
            <p style="margin:0 auto 1.5rem">{{ __('site.cta_lead') }}</p>
            <div class="hero__cta" style="justify-content:center">
                <a href="{{ route('appointment.create') }}" class="btn btn--light">{{ __('site.request_consultation') }}</a>
                <a href="https://wa.me/{{ config('site.whatsapp') }}" class="btn btn--whatsapp" target="_blank" rel="noopener">{{ __('site.whatsapp_us') }}</a>
            </div>
        </div>
    </section>
@endsection
