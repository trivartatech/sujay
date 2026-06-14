<div class="disclaimer">
    <div class="container">
        <strong>Medical disclaimer:</strong> The content on this website is for general informational purposes only and is not a substitute for professional medical advice, diagnosis, or treatment. Always consult a qualified healthcare provider for any questions regarding a medical condition.
    </div>
</div>

<footer class="site-footer">
    <div class="container">
        <div class="footer__grid">
            <div>
                <h4>Dr Sujay J</h4>
                <p>Cardiac &amp; cardiothoracic surgeon dedicated to advanced, compassionate heart care — from CABG and valve surgery to pediatric cardiac procedures.</p>
                <a class="btn btn--whatsapp" href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener">Chat on WhatsApp</a>
            </div>
            <div>
                <h4>Explore</h4>
                <ul class="footer__links">
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('procedures.index') }}">Procedures</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('appointment.create') }}">Book Appointment</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4>Get in touch</h4>
                <ul class="footer__links">
                    <li><a href="tel:{{ config('site.phone') }}">{{ config('site.phone_display') }}</a></li>
                    <li><a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
                    @if(config('site.address'))
                        <li>{{ config('site.address') }}</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="footer__bottom">
            <span>&copy; {{ now()->year }} Dr Sujay J. All rights reserved.</span>
            <span>{{ config('site.domain') }}</span>
        </div>
    </div>
</footer>
