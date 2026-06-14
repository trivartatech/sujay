<header class="site-header">
    <div class="container nav">
        <a href="{{ route('home') }}" class="brand">
            Dr Sujay J
            <small>Cardiac &amp; Cardiothoracic Surgeon</small>
        </a>

        <button class="nav__toggle" aria-label="Toggle menu">&#9776;</button>

        <ul class="nav__links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('procedures.index') }}">Procedures</a></li>
            <li><a href="{{ route('blog.index') }}">Blog</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('appointment.create') }}" class="btn btn--primary">Book Appointment</a></li>
        </ul>
    </div>
</header>
