@extends('layouts.app')

@section('title', $procedure->meta_title ?: $procedure->title)
@section('description', $procedure->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($procedure->summary), 155))

@push('head')
    <script type="application/ld+json">
    {!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'MedicalProcedure',
        'name' => $procedure->title,
        'description' => strip_tags($procedure->summary ?? ''),
        'url' => route('services.show', $procedure),
        'performer' => ['@type' => 'Physician', 'name' => config('site.name')],
    ]), JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> ·
                <a href="{{ route('services.index') }}">Services</a> ·
                {{ $procedure->title }}
            </div>
            <h1>{{ $procedure->title }}</h1>
            @if($procedure->summary)<p>{{ $procedure->summary }}</p>@endif
        </div>
    </section>

    <section class="section">
        <div class="container split split--start">
            <article class="prose" style="max-width:none">
                @if($procedure->image)
                    <img src="{{ asset('storage/'.$procedure->image) }}" alt="{{ $procedure->title }}">
                @endif

                {!! $procedure->body !!}

                <p style="margin-top:2rem">
                    <a href="{{ route('appointment.create') }}" class="btn btn--primary">Request Consultation</a>
                    <a href="https://wa.me/{{ config('site.whatsapp') }}" class="btn btn--whatsapp" target="_blank" rel="noopener">Ask on WhatsApp</a>
                </p>
            </article>

            <aside>
                <div class="form">
                    <h3 style="margin-top:0">Other services</h3>
                    <ul class="footer__links" style="list-style:none;padding:0">
                        @foreach($related as $item)
                            <li style="margin-bottom:.6rem"><a href="{{ route('services.show', $item) }}">{{ $item->title }} →</a></li>
                        @endforeach
                    </ul>
                    <a href="{{ route('services.index') }}" class="btn btn--outline" style="margin-top:.6rem;width:100%">All services</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
