@props(['name' => 'heart-pulse'])

@php
    $common = 'fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"';
@endphp

@switch($name)
    @case('heart-pulse')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M3.22 13H9l.5-1 2 4 1.5-3 1 2h5.73"/></svg>
        @break

    @case('heart-artery')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M7 11 16.5 7"/><circle cx="11.6" cy="9.1" r="1" fill="currentColor" stroke="none"/></svg>
        @break

    @case('heart-failure')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 6v5.5M9.4 9 12 11.6 14.6 9"/></svg>
        @break

    @case('activity')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M2 12h4l3 8 4-16 3 8h6"/></svg>
        @break

    @case('valve')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><circle cx="12" cy="12" r="9"/><path d="M12 12V3.2M12 12l7.6 4.4M12 12L4.4 16.4"/><circle cx="12" cy="12" r="1.5" fill="currentColor" stroke="none"/></svg>
        @break

    @case('syringe')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="m18 2 4 4M17 7l3-3M9 15l6-6M13 5l6 6-8 8H5v-6Z"/><path d="m10 12 2 2M7 15l2 2"/></svg>
        @break

    @case('lungs')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M12 3v9"/><path d="M9 12c0-2-1-3-2.5-3S4 10.5 4 13c0 3 .5 5 1 6.5.3 1 1.2 1.5 2.2 1.2 1-.3 1.8-1.2 1.8-2.4V12Z"/><path d="M15 12c0-2 1-3 2.5-3S20 10.5 20 13c0 3-.5 5-1 6.5-.3 1-1.2 1.5-2.2 1.2-1-.3-1.8-1.2-1.8-2.4V12Z"/></svg>
        @break

    @case('stethoscope')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M4 3v6a4 4 0 0 0 8 0V3"/><path d="M4 3H2m8 0h2"/><path d="M8 13v3a5 5 0 0 0 10 0v-2"/><circle cx="18" cy="11" r="2"/></svg>
        @break

    @case('shield-check')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5Z"/><path d="m9 12 2 2 4-4"/></svg>
        @break

    @case('users')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        @break

    @case('check-circle')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><circle cx="12" cy="12" r="9"/><path d="m8.5 12 2.5 2.5 4.5-5"/></svg>
        @break

    @case('phone')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/></svg>
        @break

    @case('mail')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 6 10 7L22 6"/></svg>
        @break

    @case('map-pin')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
        @break

    @case('clock')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
        @break

    @case('calendar')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/></svg>
        @break

    @case('book')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/></svg>
        @break

    @case('whatsapp')
        <svg viewBox="0 0 24 24" {{ $attributes }} fill="currentColor"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.82 11.82 0 018.413 3.488 11.82 11.82 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.82 9.82 0 001.51 5.26l-.999 3.648 3.477-.917zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/></svg>
        @break

    @case('facebook')
        <svg viewBox="0 0 24 24" {{ $attributes }} fill="currentColor"><path d="M14 9h3V5h-3c-2.2 0-4 1.8-4 4v2H7v4h3v6h4v-6h3l1-4h-4V9c0-.6.4-1 1-1Z"/></svg>
        @break

    @case('instagram')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="3.6"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/></svg>
        @break

    @case('linkedin')
        <svg viewBox="0 0 24 24" {{ $attributes }} fill="currentColor"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9h4v12H3zM10 9h3.8v1.7h.05a4.2 4.2 0 0 1 3.75-2c4 0 4.4 2.4 4.4 5.6V21h-4v-5.3c0-1.3 0-2.9-1.8-2.9s-2.1 1.4-2.1 2.8V21h-4Z"/></svg>
        @break

    @case('youtube')
        <svg viewBox="0 0 24 24" {{ $attributes }} fill="currentColor"><path d="M23 12s0-3.6-.5-5.3a2.7 2.7 0 0 0-1.9-1.9C18.9 4.3 12 4.3 12 4.3s-6.9 0-8.6.5a2.7 2.7 0 0 0-1.9 1.9C1 8.4 1 12 1 12s0 3.6.5 5.3a2.7 2.7 0 0 0 1.9 1.9c1.7.5 8.6.5 8.6.5s6.9 0 8.6-.5a2.7 2.7 0 0 0 1.9-1.9C23 15.6 23 12 23 12ZM9.8 15.3V8.7l5.7 3.3Z"/></svg>
        @break

    @case('user')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><circle cx="12" cy="8" r="4"/><path d="M5 21v-1a7 7 0 0 1 14 0v1"/></svg>
        @break

    @case('user-heart')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><circle cx="9" cy="8" r="3.6"/><path d="M3.5 20v-1A5.5 5.5 0 0 1 9 13.5c.5 0 1 .07 1.5.2"/><path d="M17.6 21c1.7-1.2 3.4-2.6 3.4-4.5a1.9 1.9 0 0 0-3.4-1.2 1.9 1.9 0 0 0-3.4 1.2c0 1.9 1.7 3.3 3.4 4.5Z"/></svg>
        @break

    @case('hand-heart')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M12 8.7c1-1.5 3.5-1 3.5.9 0 1.5-1.8 2.7-3.5 3.8-1.7-1.1-3.5-2.3-3.5-3.8 0-1.9 2.5-2.4 3.5-.9Z"/><path d="M3.5 14.5c1.4-1 2.9-1 4.3 0l3 1.8a3 3 0 0 0 3 .1"/><path d="M20.5 13.5 16 17M3.5 14.5V19H7"/></svg>
        @break

    @case('target')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5" fill="currentColor" stroke="none"/></svg>
        @break

    @case('clipboard-check')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><rect x="5" y="5" width="14" height="16" rx="2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M8.5 13l2.5 2.5 4.5-5"/></svg>
        @break

    @case('institution')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M3 10 12 4l9 6"/><path d="M5 10v8M9.7 10v8M14.3 10v8M19 10v8"/><path d="M3.5 20h17"/></svg>
        @break

    @case('calendar-heart')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/><path d="M12 14.6c.8-1 2.5-.6 2.5.6 0 1-1.2 1.8-2.5 2.6-1.3-.8-2.5-1.6-2.5-2.6 0-1.2 1.7-1.6 2.5-.6Z"/></svg>
        @break

    @case('ear')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M6 8.5a6.5 6.5 0 1 1 13 0c0 6-6 6-6 9.5a3.5 3.5 0 0 1-7 0"/><path d="M8.5 8.7a3.5 3.5 0 1 1 6.6 1.6c-.6 1.2-2.1 1.6-2.1 3.2"/></svg>
        @break

    @case('chat')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><path d="M20 11.5a8 8 0 0 1-11.6 7.1L4 20l1.4-4.4A8 8 0 1 1 20 11.5Z"/><circle cx="8.5" cy="12" r="1" fill="currentColor" stroke="none"/><circle cx="12" cy="12" r="1" fill="currentColor" stroke="none"/><circle cx="15.5" cy="12" r="1" fill="currentColor" stroke="none"/></svg>
        @break

    @case('globe')
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3a14 14 0 0 1 0 18 14 14 0 0 1 0-18Z"/></svg>
        @break

    @default
        <svg viewBox="0 0 24 24" {{ $attributes }} {!! $common !!}><circle cx="12" cy="12" r="9"/></svg>
@endswitch
