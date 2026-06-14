@extends('layouts.app')

@section('title', 'Book an Appointment')
@section('description', 'Request a consultation with Dr Sujay J. Choose a preferred date and time and our team will confirm.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · Book Appointment</div>
            <h1>Book an Appointment</h1>
            <p>Request a consultation below. Our team will call you to confirm the date and time.</p>
        </div>
    </section>

    <section class="section">
        <div class="container split">
            <div>
                <span class="eyebrow">Appointments</span>
                <h2>How it works</h2>
                <ul class="list-check">
                    <li>Submit your details and preferred time</li>
                    <li>Our team calls you to confirm availability</li>
                    <li>Bring any prior reports to your consultation</li>
                </ul>
                <p>Prefer to talk now? Call <a href="tel:{{ config('site.phone') }}">{{ config('site.phone_display') }}</a> or
                    <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener">message us on WhatsApp</a>.</p>
            </div>

            <div>
                @if(session('status'))
                    <div class="alert alert--success">{{ session('status') }}</div>
                @endif

                <form class="form" action="{{ route('appointment.store') }}" method="POST">
                    @csrf
                    <h3 style="margin-top:0">Appointment request</h3>

                    <div class="field">
                        <label for="name">Full name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone *</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}">
                        @error('email') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="preferred_date">Preferred date</label>
                        <input type="date" id="preferred_date" name="preferred_date" value="{{ old('preferred_date') }}" min="{{ now()->toDateString() }}">
                        @error('preferred_date') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="preferred_time">Preferred time</label>
                        <input type="text" id="preferred_time" name="preferred_time" value="{{ old('preferred_time') }}" placeholder="e.g. Morning, or 11:00 AM">
                    </div>

                    <div class="field">
                        <label for="reason">Reason for visit</label>
                        <textarea id="reason" name="reason" placeholder="Briefly describe your concern (optional)">{{ old('reason') }}</textarea>
                        @error('reason') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    {{-- Honeypot --}}
                    <div class="honeypot" aria-hidden="true">
                        <label>Leave this empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <div class="field field--check">
                        <input type="checkbox" id="consent" name="consent" value="1" {{ old('consent') ? 'checked' : '' }} required>
                        <label for="consent">I consent to my details being used to contact me about this appointment, in line with the <a href="#">privacy policy</a>.</label>
                    </div>
                    @error('consent') <div class="error">{{ $message }}</div> @enderror

                    <button type="submit" class="btn btn--primary">Request Appointment</button>
                </form>
            </div>
        </div>
    </section>
@endsection
