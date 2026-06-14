@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="container hero__grid">
            <div>
                <span class="hero__badge">🫀 Cardiac &amp; Cardiothoracic Surgeon</span>
                <h1>Expert heart care you can trust</h1>
                <p class="hero__lead">Dr Sujay J specialises in advanced cardiac surgery — coronary bypass, valve repair and replacement, and pediatric cardiac procedures — delivered with precision and genuine compassion.</p>
                <div class="hero__cta">
                    <a href="{{ route('appointment.create') }}" class="btn btn--primary">Book an Appointment</a>
                    <a href="tel:{{ config('site.phone') }}" class="btn btn--ghost">Call {{ config('site.phone_display') }}</a>
                </div>

                <div class="stats">
                    <div class="stat"><strong>{{ $stats['years'] ?: '—' }}+</strong><span>Years of experience</span></div>
                    <div class="stat"><strong>{{ $stats['surgeries'] ?: '—' }}+</strong><span>Surgeries performed</span></div>
                    <div class="stat"><strong>24/7</strong><span>Emergency support</span></div>
                </div>
            </div>
            <div>
                <div class="hero__photo hero__photo--placeholder">Surgeon photo</div>
            </div>
        </div>
    </section>

    {{-- Procedures --}}
    <section class="section">
        <div class="container">
            <div class="section__head">
                <span class="eyebrow">What we treat</span>
                <h2>Procedures &amp; Services</h2>
                <p>Comprehensive surgical care across the full spectrum of heart conditions.</p>
            </div>

            @if($procedures->isEmpty())
                <p style="text-align:center;color:var(--muted)">Procedures will be listed here soon.</p>
            @else
                <div class="grid grid--3">
                    @foreach($procedures as $procedure)
                        <a class="card" href="{{ route('procedures.show', $procedure) }}" style="text-decoration:none;color:inherit">
                            <div class="card__body">
                                <h3>{{ $procedure->title }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit($procedure->summary, 110) }}</p>
                                <span class="card__more">Learn more →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <p style="text-align:center;margin-top:2rem">
                    <a href="{{ route('procedures.index') }}" class="btn btn--ghost">View all procedures</a>
                </p>
            @endif
        </div>
    </section>

    {{-- Trust / why choose --}}
    <section class="section section--soft">
        <div class="container split">
            <div>
                <span class="eyebrow">Why patients choose Dr Sujay</span>
                <h2>Precision surgery, personal care</h2>
                <p>Every patient receives a clear diagnosis, a treatment plan explained in plain language, and surgical care backed by years of specialised cardiac experience.</p>
                <ul class="list-check">
                    <li>Fellowship-trained cardiac &amp; cardiothoracic surgeon</li>
                    <li>Experience across adult and pediatric cardiac surgery</li>
                    <li>Minimally invasive options where clinically appropriate</li>
                    <li>Transparent guidance from consultation to recovery</li>
                </ul>
                <a href="{{ route('about') }}" class="btn btn--primary">About Dr Sujay J</a>
            </div>
            <div>
                <div class="hero__photo hero__photo--placeholder">Clinic / portrait</div>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    @if($testimonials->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="section__head">
                    <span class="eyebrow">Patient stories</span>
                    <h2>What our patients say</h2>
                </div>
                <div class="grid grid--3">
                    @foreach($testimonials as $testimonial)
                        <figure class="quote">
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

    {{-- Latest from blog --}}
    @if($posts->isNotEmpty())
        <section class="section section--soft">
            <div class="container">
                <div class="section__head">
                    <span class="eyebrow">Heart health</span>
                    <h2>From the blog</h2>
                </div>
                <div class="grid grid--3">
                    @foreach($posts as $post)
                        @include('blog.partials.card', ['post' => $post])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA band --}}
    <section class="page-band" style="text-align:center">
        <div class="container">
            <h1>Ready to take the next step?</h1>
            <p style="margin:0 auto 1.5rem">Book a consultation with Dr Sujay J — or reach out on WhatsApp for a quick query.</p>
            <div class="hero__cta" style="justify-content:center">
                <a href="{{ route('appointment.create') }}" class="btn btn--light">Book an Appointment</a>
                <a href="https://wa.me/{{ config('site.whatsapp') }}" class="btn btn--whatsapp" target="_blank" rel="noopener">WhatsApp Us</a>
            </div>
        </div>
    </section>
@endsection
