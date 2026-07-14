@extends('layouts.app')

@section('title', $article->meta_title ?: $article->title)
@section('description', $article->meta_description ?: \Illuminate\Support\Str::limit($article->excerpt ?: strip_tags($article->body), 155))

@push('head')
    <script type="application/ld+json">
    {!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'MedicalWebPage',
        'name' => $article->title,
        'description' => \Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->body), 200),
        'url' => route('library.article', [$section, $article]),
        'about' => $section->title,
        'author' => ['@type' => 'Person', 'name' => config('site.name')],
    ]), JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> ·
                <a href="{{ route('library.index') }}">Heart Health Library</a> ·
                <a href="{{ route('library.section', $section) }}">{{ $section->title }}</a>
            </div>
            <h1>{{ $article->title }}</h1>
        </div>
    </section>

    <section class="section">
        <div class="container article">
            <article class="prose" style="max-width:none">
                @if($article->image)
                    <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                @endif

                {!! $article->body !!}

                <div class="quote" style="margin-top:2rem">
                    <strong>Have a question about your heart or lung health?</strong>
                    <p style="font-style:normal;margin:.6rem 0 0">
                        <a href="{{ route('appointment.create') }}" class="btn btn--primary">Request Consultation</a>
                    </p>
                </div>

                <p style="margin-top:1.5rem">
                    <a href="{{ route('library.section', $section) }}" class="btn btn--outline">← Back to {{ $section->title }}</a>
                </p>
            </article>
        </div>
    </section>

    @if($related->isNotEmpty())
        <section class="section section--soft">
            <div class="container">
                <div class="section__head"><h2>More in {{ $section->title }}</h2></div>
                <div class="grid grid--3">
                    @foreach($related as $item)
                        <a class="card" href="{{ route('library.article', [$section, $item]) }}">
                            @if($item->image)
                                <img class="card__img" src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" loading="lazy">
                            @endif
                            <div class="card__body">
                                <h3>{{ $item->title }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit($item->excerpt ?: strip_tags($item->body), 100) }}</p>
                                <span class="card__more">Read more →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
