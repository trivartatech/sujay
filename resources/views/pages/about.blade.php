@extends('layouts.app')

@section('title', 'About Dr Sujay J')
@section('description', 'Meet Dr Sujay J — cardiac & cardiothoracic surgeon experienced in CABG, valve surgery, and pediatric cardiac procedures.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · About</div>
            <h1>About Dr Sujay J</h1>
            <p>Cardiac &amp; cardiothoracic surgeon committed to evidence-based, compassionate heart care.</p>
        </div>
    </section>

    <section class="section">
        <div class="container split">
            <div>
                <div class="hero__photo hero__photo--placeholder">Portrait</div>
            </div>
            <div class="prose">
                <span class="eyebrow">Profile</span>
                <h2>A surgeon dedicated to your heart</h2>
                <p>Dr Sujay J is a cardiac and cardiothoracic surgeon with extensive experience across coronary artery bypass grafting (CABG), heart valve repair and replacement, angioplasty, and pediatric cardiac surgery. His practice is built on accurate diagnosis, clear communication, and surgical precision.</p>
                <p>Patients value his calm, thorough approach — from the first consultation through surgery and recovery, every step is explained in plain language so families can make confident decisions.</p>

                <h2>Qualifications</h2>
                <ul class="list-check">
                    <li>MBBS</li>
                    <li>MS — General Surgery</li>
                    <li>MCh — Cardiothoracic &amp; Vascular Surgery</li>
                    <li>Fellowships in advanced cardiac surgery</li>
                </ul>

                <h2>Areas of focus</h2>
                <ul class="list-check">
                    <li>Coronary artery bypass grafting (CABG)</li>
                    <li>Heart valve repair &amp; replacement</li>
                    <li>Minimally invasive cardiac surgery</li>
                    <li>Pediatric &amp; congenital heart surgery</li>
                </ul>

                <p style="margin-top:1.5rem">
                    <a href="{{ route('appointment.create') }}" class="btn btn--primary">Book a Consultation</a>
                </p>
            </div>
        </div>
    </section>

    <section class="section section--soft">
        <div class="container">
            <div class="stats" style="margin-top:0">
                <div class="stat"><strong>{{ $stats['years'] ?: '—' }}+</strong><span>Years of experience</span></div>
                <div class="stat"><strong>{{ $stats['surgeries'] ?: '—' }}+</strong><span>Surgeries performed</span></div>
                <div class="stat"><strong>24/7</strong><span>Emergency support</span></div>
            </div>
        </div>
    </section>
@endsection
