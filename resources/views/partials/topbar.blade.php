<div class="topbar">
    <div class="container">
        <span class="topbar__item">
            <x-ui-icon name="heart-pulse" style="width:14px;height:14px" />
            {{ __('site.tagline') }}
        </span>

        <span class="topbar__right">
            <a class="topbar__item" href="{{ route('appointment.create') }}">
                <x-ui-icon name="calendar" style="width:14px;height:14px" />
                {{ __('site.book_appointment') }}
            </a>
            <a class="topbar__item" href="tel:{{ config('site.phone') }}">
                <x-ui-icon name="phone" style="width:14px;height:14px" />
                {{ __('site.emergency_call') }}
            </a>
        </span>
    </div>
</div>
