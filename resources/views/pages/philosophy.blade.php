@extends('layouts.app')

@section('title', 'Philosophy of Care')
@section('description', 'Every patient has a story. Good cardiology begins by listening — Dr. Sujay J on compassionate, patient-centred heart care.')

@php $v = fn($p) => asset($p).'?v='.(@filemtime(public_path($p)) ?: '1'); @endphp

@section('content')

    {{-- ── Hero ───────────────────────────────────────────── --}}
    <section class="phil-hero">
        <div class="container phil-hero__grid">
            <div>
                <div class="breadcrumb" style="color:var(--muted)">
                    <a href="{{ route('home') }}">Home</a> <span style="color:var(--line)">›</span> Philosophy of Care
                </div>
                <h1 class="phil-hero__title"><span class="navy">My Philosophy</span><br><span class="red">of Care</span></h1>
                <span class="phil-underline"></span>
                <blockquote class="phil-hero__quote">
                    <span class="q q--open">&ldquo;</span>
                    Every patient has a story.<br>
                    Good cardiology begins by listening.
                    <span class="q q--close">&rdquo;</span>
                </blockquote>
            </div>
            <div class="phil-hero__art">
                <img src="{{ $v('images/philosophy/hero-heart.png') }}" alt="Heart with pulse">
            </div>
        </div>
    </section>

    {{-- ── Intro line ──────────────────────────────────────── --}}
    <section class="section" style="padding-bottom:1rem">
        <div class="container" style="max-width:720px;text-align:center">
            <h2 style="font-size:clamp(1.25rem,2.4vw,1.6rem);line-height:1.5">Heart care is about more than treating a disease&mdash; it's about understanding the person behind it.</h2>
            <div class="heart-divider">
                <span></span><x-ui-icon name="heart-pulse" style="width:22px;height:22px;color:var(--red-600)" /><span></span>
            </div>
        </div>
    </section>

    {{-- ── 6 value cards ───────────────────────────────────── --}}
    <section class="section" style="padding-top:1rem">
        <div class="container container--wide">
            <div class="value-grid">
                <div class="value-card">
                    <span class="value-card__icon"><x-ui-icon name="ear" /></span>
                    <h3>You Are Heard</h3>
                    <p>I believe every patient deserves to be heard, treated with respect, and involved in decisions about their care.</p>
                </div>
                <div class="value-card">
                    <span class="value-card__icon"><x-ui-icon name="clipboard-check" /></span>
                    <h3>Evidence-Based Care</h3>
                    <p>My approach combines careful clinical evaluation, evidence-based medicine, and clear communication to create a treatment plan tailored to your needs.</p>
                </div>
                <div class="value-card">
                    <span class="value-card__icon"><x-ui-icon name="shield-check" /></span>
                    <h3>Prevention Matters</h3>
                    <p>Managing blood pressure, cholesterol, diabetes, lifestyle, and other risk factors can make a meaningful difference in your long-term heart health.</p>
                </div>
                <div class="value-card">
                    <span class="value-card__icon"><x-ui-icon name="chat" /></span>
                    <h3>Clear &amp; Open Communication</h3>
                    <p>I take time to explain your condition, discuss the purpose of tests or treatments, and answer your questions in simple, understandable language.</p>
                </div>
                <div class="value-card">
                    <span class="value-card__icon"><x-ui-icon name="user-heart" /></span>
                    <h3>Personalised Treatment</h3>
                    <p>Every heart is different. Your care plan is individualised based on your health, lifestyle, preferences, and goals.</p>
                </div>
                <div class="value-card">
                    <span class="value-card__icon"><x-ui-icon name="hand-heart" /></span>
                    <h3>Compassionate Partnership</h3>
                    <p>Whether it's prevention, a new diagnosis, or ongoing care, you can expect honest, compassionate, and patient-centred care.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── My Commitment to You ────────────────────────────── --}}
    <section class="section" style="padding-top:0">
        <div class="container">
            <div class="commit-card">
                <div class="commit-card__art">
                    <img src="{{ $v('images/philosophy/commitment-heart.png') }}" alt="Anatomical heart">
                </div>
                <div class="commit-card__text">
                    <span class="phil-underline phil-underline--sm"></span>
                    <h2>My Commitment to You</h2>
                    <p>I am committed to providing compassionate, ethical, and patient-centred care built on trust and partnership. My goal is to support you at every step of your heart health journey.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── My Goal is Simple (navy) ────────────────────────── --}}
    <section class="section" style="padding-top:0">
        <div class="container">
            <div class="goal-card">
                <div class="goal-card__icon">
                    <svg viewBox="0 0 72 72" fill="none" aria-hidden="true">
                        <circle cx="33" cy="39" r="24" stroke="#ffffff" stroke-width="3.4"/>
                        <circle cx="33" cy="39" r="15.5" stroke="#e23b4e" stroke-width="3.4"/>
                        <circle cx="33" cy="39" r="7.5" fill="#e23b4e"/>
                        <circle cx="33" cy="39" r="3" fill="#ffffff"/>
                        <path d="M33 39 59 13" stroke="#ffffff" stroke-width="3.4" stroke-linecap="round"/>
                        <path d="M51 13h9v9" stroke="#ffffff" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="goal-card__text">
                    <h2>My Goal is Simple</h2>
                    <p>To help you understand your heart, make informed decisions, and support you in achieving the best possible cardiovascular health&mdash; today and for years to come.</p>
                </div>
                <span class="goal-card__quote">&rdquo;</span>
            </div>
        </div>
    </section>

    {{-- ── CTA strip ───────────────────────────────────────── --}}
    <section class="section" style="padding-top:0">
        <div class="container">
            <div class="cta-strip">
                <div class="cta-strip__lead">
                    <span class="cta-strip__icon cta-strip__icon--img"><img src="{{ $v('images/philosophy/cta-calendar.png') }}" alt=""></span>
                    <div>
                        <h3>Let's Work Together for Your Heart Health</h3>
                        <p>Book an appointment to discuss your concerns and create a personalised care plan.</p>
                    </div>
                </div>
                <div class="cta-strip__actions">
                    <a href="{{ route('appointment.create') }}" class="btn btn--primary"><x-ui-icon name="calendar" style="width:16px;height:16px" /> Book Appointment</a>
                    <a href="tel:{{ config('site.phone') }}" class="btn btn--outline"><x-ui-icon name="phone" style="width:16px;height:16px" /> Call Now</a>
                </div>
            </div>
        </div>
    </section>
@endsection
