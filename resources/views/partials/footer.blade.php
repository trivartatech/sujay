@php
    $footerServices = \App\Models\Procedure::published()->orderBy('sort_order')->take(7)->get(['title', 'slug']);
    $socials = array_filter(config('site.social'));
@endphp

<footer class="site-footer">
    <div class="container">
        <div class="footer__grid">
            <div>
                <h4>{{ __('site.footer_about') }}</h4>
                <p>{{ __('site.footer_about_text') }}</p>
                @if($socials)
                    <div class="socials">
                        @foreach($socials as $network => $url)
                            <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($network) }}">
                                <x-ui-icon :name="$network" />
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h4>{{ __('site.footer_quick_links') }}</h4>
                <ul class="footer__links">
                    <li><a href="{{ route('home') }}">{{ __('site.nav_home') }}</a></li>
                    <li><a href="{{ route('about') }}">{{ __('site.nav_meet') }}</a></li>
                    <li><a href="{{ route('services.index') }}">{{ __('site.nav_services') }}</a></li>
                    <li><a href="{{ route('library.index') }}">{{ __('site.nav_library') }}</a></li>
                    <li><a href="{{ route('blog.index') }}">{{ __('site.nav_blog') }}</a></li>
                    <li><a href="{{ route('faqs') }}">{{ __('site.nav_faqs') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('site.nav_contact') }}</a></li>
                </ul>
            </div>

            <div>
                <h4>{{ __('site.footer_our_services') }}</h4>
                <ul class="footer__links">
                    @forelse($footerServices as $service)
                        <li><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></li>
                    @empty
                        <li><a href="{{ route('services.index') }}">View all services</a></li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h4>{{ __('site.footer_contact_us') }}</h4>
                <ul class="footer__links footer__contact">
                    @if(config('site.address'))
                        <li>
                            <x-ui-icon name="map-pin" />
                            @if(config('site.map_url'))
                                <a href="{{ config('site.map_url') }}" target="_blank" rel="noopener">{{ config('site.address') }}</a>
                            @else
                                <span>{{ config('site.address') }}</span>
                            @endif
                        </li>
                    @endif
                    <li><x-ui-icon name="phone" /><a href="tel:{{ config('site.phone') }}">{{ config('site.phone_display') }}</a></li>
                    <li><x-ui-icon name="mail" /><a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
                    <li><x-ui-icon name="clock" /><span>{{ config('site.hours') }}</span></li>
                </ul>
            </div>

            <div>
                <h4>{{ __('site.footer_meet_doctor') }}</h4>
                <p>{{ config('site.name') }} is a Consultant {{ config('site.specialty') }} committed to prevention, early diagnosis, and long-term heart care.</p>
                <a href="{{ route('about') }}" class="btn btn--red" style="margin-top:.4rem">{{ __('site.know_more') }}</a>
            </div>
        </div>

        <div class="footer__bottom">
            <span>&copy; {{ now()->year }} {{ config('site.name') }}. {{ __('site.footer_rights') }}</span>
            <span class="footer__credit">
                {{ __('site.designed_with') }} <span class="footer__heart" aria-label="love">&#10084;</span> {{ __('site.designed_by') }}
                <a href="https://trivarta.in" target="_blank" rel="noopener">Trivarta Tech Pvt Ltd</a>
            </span>
            <span>
                <a href="{{ route('contact') }}">{{ __('site.privacy_policy') }}</a>
                &nbsp;|&nbsp;
                <a href="#medical-disclaimer">{{ __('site.medical_disclaimer') }}</a>
            </span>
        </div>

        <p id="medical-disclaimer" style="font-size:.75rem;color:#7b98b8;margin-top:1rem">
            <strong>{{ __('site.medical_disclaimer') }}:</strong> {{ __('site.disclaimer_text') }}
        </p>
    </div>
</footer>
