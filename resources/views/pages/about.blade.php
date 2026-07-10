@extends('layouts.app')

@section('title', 'Meet Dr. Sujay J')
@section('description', 'Meet Dr. Sujay J — Consultant Cardiologist & Pulmonologist focused on prevention, early diagnosis, and long-term heart and lung wellness.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · Meet Dr. Sujay</div>
            <h1>Meet Dr. Sujay J</h1>
            <p>Consultant {{ config('site.specialty') }} — your partner in heart and lung health.</p>
        </div>
    </section>

    <section class="section">
        <div class="container split split--start">
            <div>
                <div class="doctor-photo doctor-photo--ph">Portrait</div>

                <div class="form" style="margin-top:1.4rem">
                    <h3 style="margin-top:0">At a glance</h3>
                    <ul class="list-check" style="margin:0">
                        <li>{{ $stats['years'] ?: '—' }}+ years of clinical experience</li>
                        <li>{{ $stats['patients'] ?: '—' }}+ patients treated</li>
                        <li>Cardiology &amp; pulmonology under one roof</li>
                    </ul>
                    <a href="{{ route('appointment.create') }}" class="btn btn--red" style="margin-top:1rem;width:100%">Request Consultation</a>
                </div>
            </div>

            <div class="prose" style="max-width:none">
                <span class="eyebrow">Profile</span>
                <h2>Your Partner in Heart Health</h2>
                <p>Dr. Sujay J is a Consultant Cardiologist &amp; Pulmonologist dedicated to providing personalized, compassionate and advanced care. His practice spans preventive cardiology, coronary artery disease, heart failure management, arrhythmia care, valvular heart disease, interventional cardiology, and pulmonary care.</p>
                <p>Patients value his calm, thorough approach — from the first consultation through diagnosis, treatment and follow-up, every step is explained in plain language so families can make confident decisions.</p>

                <h2>Qualifications</h2>
                <ul class="list-check">
                    <li>MBBS</li>
                    <li>MD — General Medicine</li>
                    <li>DM — Cardiology</li>
                    <li>Fellowship in Interventional Cardiology</li>
                </ul>

                <h2>Areas of expertise</h2>
                <ul class="list-check">
                    <li>Preventive cardiology &amp; risk assessment</li>
                    <li>Coronary artery disease and angioplasty</li>
                    <li>Heart failure &amp; arrhythmia management</li>
                    <li>Valvular heart disease</li>
                    <li>Pulmonary and respiratory care</li>
                </ul>

                <p style="margin-top:1.5rem">
                    <a href="{{ route('philosophy') }}" class="btn btn--outline">Read my philosophy of care</a>
                </p>
            </div>
        </div>
    </section>
@endsection
