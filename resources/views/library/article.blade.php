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
        <div class="container split split--start">
            <article class="prose" style="max-width:none">
                @if($article->image)
                    <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                @endif

                {!! $article->body !!}

                <div class="quote" style="margin-top:2rem;border-left-color:var(--navy-700)">
                    <strong>Have a question about your heart or lung health?</strong>
                    <p style="font-style:normal;margin:.6rem 0 0">
                        <a href="{{ route('appointment.create') }}" class="btn btn--primary">Request Consultation</a>
                    </p>
                </div>
            </article>

            <aside>
                @if($related->isNotEmpty())
                    <div class="form">
                        <h3 style="margin-top:0">More in {{ $section->title }}</h3>
                        <ul class="footer__links" style="list-style:none;padding:0">
                            @foreach($related as $item)
                                <li style="margin-bottom:.6rem"><a href="{{ route('library.article', [$section, $item]) }}">{{ $item->title }} →</a></li>
                            @endforeach
                        </ul>
                        <a href="{{ route('library.section', $section) }}" class="btn btn--outline" style="margin-top:.6rem;width:100%">Back to {{ $section->title }}</a>
                    </div>
                @endif
            </aside>
        </div>
    </section>
@endsection
