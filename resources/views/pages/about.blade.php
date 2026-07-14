@extends('layouts.app')

@section('title', 'Meet Dr. Sujay J')
@section('description', 'Dr. Sujay J — Consultant Interventional Cardiologist. Evidence-based diagnosis, advanced treatment, and long-term heart care tailored to each patient.')

@section('content')

    {{-- ── Hero ───────────────────────────────────────────── --}}
    <section class="about-hero">
        <div class="container about-hero__grid">
            <div class="about-hero__intro">
                <div class="breadcrumb" style="color:var(--muted)">
                    <a href="{{ route('home') }}">Home</a> <span style="color:var(--line)">›</span> Meet Dr. Sujay
                </div>
                <p class="about-hero__eyebrow">About</p>
                <h1 class="about-hero__name">Dr. Sujay J</h1>
                <p class="about-hero__role">Consultant Interventional Cardiologist</p>
                <p class="about-hero__degrees">MBBS &nbsp;|&nbsp; MD (Medicine) &nbsp;|&nbsp; DM (Cardiology)</p>
                <p class="about-hero__lead">With a strong foundation in Cardiology, I provide evidence-based diagnosis, advanced treatment, and long-term care tailored to each patient's needs.</p>

                <div class="stat-row">
                    <div class="stat-item">
                        <span class="stat-item__icon"><x-ui-icon name="user" /></span>
                        <span class="stat-item__label">8+ Years<br>Experience</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-item__icon stat-item__icon--badge" data-badge="24"><x-ui-icon name="phone" /></span>
                        <span class="stat-item__label">24/7 Emergency<br>Support</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-item__icon"><x-ui-icon name="shield-check" /></span>
                        <span class="stat-item__label">Advanced<br>Technology</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-item__icon"><x-ui-icon name="target" /></span>
                        <span class="stat-item__label">Focused on<br>Long-term Wellness</span>
                    </div>
                </div>
            </div>

            <div class="about-hero__photo">
                <img src="{{ asset('images/dr-sujay.jpg') }}?v={{ @filemtime(public_path('images/dr-sujay.jpg')) ?: '1' }}" alt="Dr. Sujay J, Consultant Interventional Cardiologist">
            </div>
        </div>
    </section>

    {{-- ── Areas of Expertise + Why Patients Trust ─────────── --}}
    <section class="section">
        <div class="container expertise-grid">
            <div>
                <h2 class="sec-title">Areas of Expertise</h2>
                <ul class="expertise-list">
                    <li>
                        <span class="expertise-list__icon"><x-ui-icon name="heart-artery" /></span>
                        <span><strong>Coronary Artery Disease</strong><br>Diagnosis &amp; Management</span>
                    </li>
                    <li>
                        <span class="expertise-list__icon"><x-ui-icon name="syringe" /></span>
                        <span><strong>Coronary Interventions</strong><br>Angioplasty &amp; Stenting</span>
                    </li>
                    <li>
                        <span class="expertise-list__icon"><x-ui-icon name="heart-failure" /></span>
                        <span><strong>Heart Failure</strong><br>Management</span>
                    </li>
                    <li>
                        <span class="expertise-list__icon"><x-ui-icon name="activity" /></span>
                        <span><strong>Arrhythmia Evaluation</strong><br>&amp; Management</span>
                    </li>
                    <li>
                        <span class="expertise-list__icon"><x-ui-icon name="shield-check" /></span>
                        <span><strong>Preventive Cardiology</strong><br>&amp; Risk Reduction</span>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="sec-title">Why Patients Trust Dr. Sujay J</h2>
                <div class="trust-grid">
                    <div class="trust-card">
                        <span class="trust-card__icon"><x-ui-icon name="clipboard-check" /></span>
                        <h3>Evidence-Based Care</h3>
                        <p>Every decision is guided by the latest research and guidelines.</p>
                    </div>
                    <div class="trust-card">
                        <span class="trust-card__icon"><x-ui-icon name="user-heart" /></span>
                        <h3>Personalized Treatment</h3>
                        <p>Care tailored to your condition, goals and lifestyle.</p>
                    </div>
                    <div class="trust-card">
                        <span class="trust-card__icon"><x-ui-icon name="heart-pulse" /></span>
                        <h3>Advanced Interventions</h3>
                        <p>Expertise in modern interventional procedures for better outcomes.</p>
                    </div>
                    <div class="trust-card">
                        <span class="trust-card__icon"><x-ui-icon name="hand-heart" /></span>
                        <h3>Compassionate Follow-up</h3>
                        <p>Long-term partnership for your heart health at every step.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Education & Training ─────────────────────────────── --}}
    <section class="section section--soft">
        <div class="container">
            <h2 class="sec-title">Education &amp; Training</h2>
            <div class="edu-timeline">
                <div class="edu-node">
                    <span class="edu-node__dot edu-node__dot--navy"><x-ui-icon name="institution" /></span>
                    <h3>MBBS</h3>
                    <p>JJM Medical College,<br>Davangere (RGUHS)</p>
                    <span class="edu-node__year">2007 – 2013</span>
                </div>
                <div class="edu-node">
                    <span class="edu-node__dot edu-node__dot--red"><x-ui-icon name="heart-pulse" /></span>
                    <h3>MD (Medicine)</h3>
                    <p>KLE University,<br>Belagavi</p>
                    <span class="edu-node__year">2014 – 2017</span>
                </div>
                <div class="edu-node">
                    <span class="edu-node__dot edu-node__dot--navy"><x-ui-icon name="heart-pulse" /></span>
                    <h3>DM (Cardiology)</h3>
                    <p>Kasturba Medical College,<br>MAHE University, Manipal</p>
                    <span class="edu-node__year">2017 – 2020</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ── My Philosophy ───────────────────────────────────── --}}
    <section class="section">
        <div class="container">
            <div class="philosophy-card">
                <div class="philosophy-card__art">
                    <img src="{{ asset('images/philosophy-heart.png') }}?v={{ @filemtime(public_path('images/philosophy-heart.png')) ?: '1' }}" alt="Anatomical heart">
                </div>
                <div class="philosophy-card__text">
                    <h2>My Philosophy</h2>
                    <p>I believe in treating every patient with compassion, empathy and respect. My goal is not just to treat disease, but to partner with my patients in achieving a healthier, longer and better life.</p>
                    <p>Through advanced technology and a patient-first approach, I deliver care that is both effective and personalised.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA strip ───────────────────────────────────────── --}}
    <section class="section" style="padding-top:0">
        <div class="container">
            <div class="cta-strip">
                <div class="cta-strip__lead">
                    <span class="cta-strip__icon"><x-ui-icon name="calendar-heart" /></span>
                    <div>
                        <h3>Let's Work Together for Your Heart Health</h3>
                        <p>Book an appointment to discuss your concerns and create a personalized plan.</p>
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
