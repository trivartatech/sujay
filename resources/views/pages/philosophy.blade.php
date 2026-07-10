@extends('layouts.app')

@section('title', 'Philosophy of Care')
@section('description', 'The principles that guide Dr. Sujay J — listen first, diagnose accurately, treat conservatively, and prevent relentlessly.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · Philosophy of Care</div>
            <h1>Philosophy of Care</h1>
            <p>Medicine works best when it is precise, preventive, and profoundly human.</p>
        </div>
    </section>

    <section class="section">
        <div class="container split split--start">
            <div class="prose" style="max-width:none">
                <span class="eyebrow">What guides my practice</span>
                <h2>Care that treats the person, not just the scan</h2>
                <p>Every heart tells a story — of genetics, habits, stress, and circumstance. My role is to read that story carefully, explain it in language you understand, and build a plan you can actually follow.</p>

                <h3>Listen first</h3>
                <p>A thorough history often reveals more than any test. Consultations are unhurried, and questions are always welcome.</p>

                <h3>Diagnose accurately</h3>
                <p>Advanced diagnostics are used purposefully — the right test at the right time, not every test all the time.</p>

                <h3>Treat proportionately</h3>
                <p>The least invasive effective treatment is the best treatment. Medication, lifestyle, and intervention each have their place, and the decision is made together.</p>

                <h3>Prevent relentlessly</h3>
                <p>The most successful cardiac treatment is the one that was never needed. Prevention, early detection, and long-term follow-up sit at the centre of the practice.</p>

                <a href="{{ route('appointment.create') }}" class="btn btn--primary" style="margin-top:1.2rem">Request Consultation</a>
            </div>

            <aside>
                <div class="doctor-photo doctor-photo--ph" style="margin-bottom:1.2rem">Consultation photo</div>
                <div class="form">
                    <h3 style="margin-top:0">Principles at a glance</h3>
                    <ul class="list-check" style="margin:0">
                        <li>Unhurried, plain-language consultations</li>
                        <li>Evidence-based, guideline-led decisions</li>
                        <li>Least invasive effective treatment</li>
                        <li>Shared decision-making with families</li>
                        <li>Long-term prevention and follow-up</li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
@endsection
