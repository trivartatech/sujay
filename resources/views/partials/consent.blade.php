{{-- Cookie consent — GA4 only loads after the visitor accepts (DPDP Act) --}}
@if(config('site.ga_id'))
    <div class="consent" id="cookieConsent" role="dialog" aria-live="polite" aria-label="Cookie notice" hidden>
        <p class="consent__text">
            We use cookies to understand how visitors use this site so we can improve it.
            No personal or medical information is collected.
            <a href="{{ route('contact') }}">Learn more</a>
        </p>
        <div class="consent__actions">
            <button type="button" class="btn btn--outline" data-consent="deny">Decline</button>
            <button type="button" class="btn btn--primary" data-consent="allow">Accept</button>
        </div>
    </div>

    <script>
        (function () {
            var GA_ID = @json(config('site.ga_id'));
            var KEY = 'cookie-consent';
            var banner = document.getElementById('cookieConsent');

            function loadGA() {
                if (window.__gaLoaded) return;
                window.__gaLoaded = true;
                var s = document.createElement('script');
                s.async = true;
                s.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
                document.head.appendChild(s);
                window.dataLayer = window.dataLayer || [];
                window.gtag = function () { window.dataLayer.push(arguments); };
                gtag('js', new Date());
                gtag('config', GA_ID, { anonymize_ip: true });
            }

            var choice = null;
            try { choice = localStorage.getItem(KEY); } catch (e) {}

            if (choice === 'allow') {
                loadGA();
            } else if (choice !== 'deny' && banner) {
                banner.hidden = false;
            }

            banner && banner.addEventListener('click', function (e) {
                var btn = e.target.closest('[data-consent]');
                if (!btn) return;
                var allow = btn.getAttribute('data-consent') === 'allow';
                try { localStorage.setItem(KEY, allow ? 'allow' : 'deny'); } catch (e) {}
                banner.hidden = true;
                if (allow) loadGA();
            });
        })();
    </script>
@endif
