@extends('layouts.app')

@section('title', 'Contact')
@section('description', 'Get in touch with Dr Sujay J — call, WhatsApp, or send a message via the contact form.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · Contact</div>
            <h1>Contact Us</h1>
            <p>We're here to help. Reach out by phone, WhatsApp, or the form below.</p>
        </div>
    </section>

    <section class="section">
        <div class="container split">
            <div>
                <span class="eyebrow">Get in touch</span>
                <h2>Clinic details</h2>
                <ul class="list-check">
                    <li><strong>Phone:</strong> <a href="tel:{{ config('site.phone') }}">{{ config('site.phone_display') }}</a></li>
                    <li><strong>WhatsApp:</strong> <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener">{{ config('site.phone_display') }}</a></li>
                    <li><strong>Email:</strong> <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
                    @if(config('site.address'))
                        <li><strong>Address:</strong> {{ config('site.address') }}</li>
                    @endif
                </ul>

                <div style="margin-top:1.5rem">
                    <a href="https://wa.me/{{ config('site.whatsapp') }}" class="btn btn--whatsapp" target="_blank" rel="noopener">Chat on WhatsApp</a>
                    <a href="{{ route('appointment.create') }}" class="btn btn--ghost">Book Appointment</a>
                </div>
            </div>

            <div>
                @if(session('status'))
                    <div class="alert alert--success">{{ session('status') }}</div>
                @endif

                <form class="form" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <h3 style="margin-top:0">Send a message</h3>

                    <div class="field">
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}">
                        @error('email') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
                    </div>

                    <div class="field">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                        @error('message') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    {{-- Honeypot --}}
                    <div class="honeypot" aria-hidden="true">
                        <label>Leave this empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <div class="field field--check">
                        <input type="checkbox" id="consent" name="consent" value="1" {{ old('consent') ? 'checked' : '' }} required>
                        <label for="consent">I consent to my details being used to respond to my enquiry, in line with the <a href="#">privacy policy</a>.</label>
                    </div>
                    @error('consent') <div class="error">{{ $message }}</div> @enderror

                    <button type="submit" class="btn btn--primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>
@endsection
