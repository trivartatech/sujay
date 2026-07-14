@extends('layouts.app')

@section('description', 'Dr. Sujay J — Consultant Cardiologist & Pulmonologist. Compassionate, evidence-based care for your heart and lung health.')

@section('content')

    {{-- ── Hero ───────────────────────────────────────────── --}}
    <section class="hero">
        <div class="container hero__grid">
            <div>
                <h1>Compassionate &amp; Expert<br>Care for Every <span class="accent">Heartbeat</span></h1>
                <p class="hero__lead">Providing comprehensive, evidence-based and compassionate care for your heart and lung health.</p>

                <div class="hero__points">
                    <span class="hero__point"><x-ui-icon name="heart-pulse" /> Personalized Care</span>
                    <span class="hero__point"><x-ui-icon name="check-circle" /> Advanced Diagnostics</span>
                    <span class="hero__point"><x-ui-icon name="users" /> Preventive Cardiology</span>
                </div>

                <div class="hero__cta">
                    <a href="{{ route('appointment.create') }}" class="btn btn--primary">Book an Appointment</a>
                    <a href="{{ route('library.index') }}" class="btn btn--outline">Explore Heart Health Library</a>
                </div>
            </div>

            <div class="hero__media">
                <div class="hero__photo hero__photo--placeholder">Doctor photo</div>
            </div>
        </div>

        <div class="hero__ecg" aria-hidden="true">
            <svg viewBox="0 0 1200 44" preserveAspectRatio="none">
                <path d="M0 26 H470 l14 0 l9 -22 l11 40 l13 -40 l9 22 l8 0 H1200" fill="none" stroke="var(--red-600)" stroke-width="2.4" stroke-linejoin="round" stroke-linecap="round"/>
            </svg>
        </div>
    </section>

    {{-- ── Comprehensive Cardiac Care ──────────────────────── --}}
    @if($services->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="section__head" style="margin-bottom:1.75rem">
                    <h2>Comprehensive Cardiac Care</h2>
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
                    <h2>Heart Health Library</h2>
                    <p>Trusted information to help you understand, prevent and manage heart conditions.</p>
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
                <div class="doctor-photo doctor-photo--ph">Doctor at desk</div>
            </div>
            <div>
                <span class="eyebrow">Why Choose Dr. Sujay J?</span>
                <h2>Your Partner in Heart Health</h2>
                <p>I am a Consultant {{ config('site.specialty') }} dedicated to providing personalized, compassionate and advanced care. My goal is to help you live a healthier, longer and better life.</p>

                <ul class="list-check">
                    <li>Extensive experience in cardiovascular care</li>
                    <li>Evidence-based treatment &amp; latest technologies</li>
                    <li>Focus on prevention, early diagnosis and long-term wellness</li>
                </ul>

                <a href="{{ route('about') }}" class="btn btn--primary">Know More About Me</a>
            </div>
        </div>
    </section>

    {{-- ── Featured Blog & Research ────────────────────────── --}}
    @if($posts->isNotEmpty())
        <section class="section section--soft">
            <div class="container">
                <div class="section__head">
                    <h2>Featured Blog &amp; Research</h2>
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
                    <a href="{{ route('blog.index') }}" class="btn btn--outline">View all articles</a>
                </p>
            </div>
        </section>
    @endif

    {{-- ── Testimonials ────────────────────────────────────── --}}
    @if($testimonials->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="section__head">
                    <h2>What Our Patients Say</h2>
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
            <h1 style="font-size:clamp(1.5rem,3vw,2.1rem)">Ready to take the next step?</h1>
            <p style="margin:0 auto 1.5rem">Request a consultation with {{ config('site.name') }}, or reach out on WhatsApp for a quick query.</p>
            <div class="hero__cta" style="justify-content:center">
                <a href="{{ route('appointment.create') }}" class="btn btn--light">Request Consultation</a>
                <a href="https://wa.me/{{ config('site.whatsapp') }}" class="btn btn--whatsapp" target="_blank" rel="noopener">WhatsApp Us</a>
            </div>
        </div>
    </section>
@endsection
