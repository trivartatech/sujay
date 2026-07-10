@php
    $footerServices = \App\Models\Procedure::published()->orderBy('sort_order')->take(7)->get(['title', 'slug']);
    $socials = array_filter(config('site.social'));
@endphp

<footer class="site-footer">
    <div class="container">
        <div class="footer__grid">
            <div>
                <h4>About</h4>
                <p>Providing comprehensive and compassionate care for your heart and lung health.</p>
                @if($socials)
                    <div class="socials">
                        @foreach($socials as $network => $url)
                            <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($network) }}">
                                <x-icon :name="$network" />
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h4>Quick Links</h4>
                <ul class="footer__links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">Meet Dr. Sujay</a></li>
                    <li><a href="{{ route('services.index') }}">Services</a></li>
                    <li><a href="{{ route('library.index') }}">Heart Health Library</a></li>
                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4>Our Services</h4>
                <ul class="footer__links">
                    @forelse($footerServices as $service)
                        <li><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></li>
                    @empty
                        <li><a href="{{ route('services.index') }}">View all services</a></li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h4>Contact Us</h4>
                <ul class="footer__links footer__contact">
                    @if(config('site.address'))
                        <li><x-icon name="map-pin" /><span>{{ config('site.address') }}</span></li>
                    @endif
                    <li><x-icon name="phone" /><a href="tel:{{ config('site.phone') }}">{{ config('site.phone_display') }}</a></li>
                    <li><x-icon name="mail" /><a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
                    <li><x-icon name="clock" /><span>{{ config('site.hours') }}</span></li>
                </ul>
            </div>

            <div>
                <h4>Meet the Doctor</h4>
                <p>{{ config('site.name') }} is a Consultant {{ config('site.specialty') }} committed to prevention, early diagnosis, and long-term heart and lung care.</p>
                <a href="{{ route('about') }}" class="btn btn--red" style="margin-top:.4rem">Know More</a>
            </div>
        </div>

        <div class="footer__bottom">
            <span>&copy; {{ now()->year }} {{ config('site.name') }}. All Rights Reserved.</span>
            <span>
                <a href="{{ route('contact') }}">Privacy Policy</a>
                &nbsp;|&nbsp;
                <a href="#medical-disclaimer">Medical Disclaimer</a>
            </span>
        </div>

        <p id="medical-disclaimer" style="font-size:.75rem;color:#7b98b8;margin-top:1rem">
            <strong>Medical disclaimer:</strong> The content on this website is for general informational purposes only and is not a substitute for professional medical advice, diagnosis, or treatment. Always consult a qualified healthcare provider for any questions regarding a medical condition.
        </p>
    </div>
</footer>
