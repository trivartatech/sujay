<header class="site-header">
    <div class="container nav">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/logo-mark.png') }}?v={{ @filemtime(public_path('images/logo-mark.png')) ?: '1' }}" alt="" class="brand__mark">
            <img src="{{ asset('images/logo-text.png') }}?v={{ @filemtime(public_path('images/logo-text.png')) ?: '1' }}" alt="{{ config('site.name') }} — {{ config('site.specialty') }}" class="brand__wordmark">
        </a>

        <button class="nav__toggle" aria-label="Toggle menu">&#9776;</button>

        <ul class="nav__links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">Meet Dr. Sujay</a></li>
            <li><a href="{{ route('philosophy') }}">Philosophy of Care</a></li>
            <li><a href="{{ route('services.index') }}">Services</a></li>

            <li class="has-drop">
                <a href="{{ route('library.index') }}">Heart Health Library</a>
                @if(!empty($navSections) && $navSections->isNotEmpty())
                    <ul class="drop">
                        @foreach($navSections as $navSection)
                            <li><a href="{{ route('library.section', $navSection) }}">{{ $navSection->title }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>

            <li><a href="{{ route('blog.index') }}">Blog</a></li>
            <li><a href="{{ route('faqs') }}">FAQs</a></li>
            <li>
                <a href="{{ route('appointment.create') }}" class="btn btn--primary">
                    <x-ui-icon name="calendar" style="width:16px;height:16px" />
                    REQUEST CONSULTATION
                </a>
            </li>
        </ul>
    </div>
</header>
