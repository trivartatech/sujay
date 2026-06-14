@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title)
@section('description', $post->meta_description ?: \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->body), 155))

@push('og')
    <meta property="og:type" content="article">
    @if($post->featured_image)
        <meta property="og:image" content="{{ asset('storage/'.$post->featured_image) }}">
    @endif
@endpush

@push('head')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post->title,
        'datePublished' => optional($post->published_at)->toAtomString(),
        'dateModified' => optional($post->updated_at)->toAtomString(),
        'author' => ['@type' => 'Person', 'name' => config('site.name')],
        'image' => $post->featured_image ? asset('storage/'.$post->featured_image) : null,
        'mainEntityOfPage' => route('blog.show', $post),
    ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> ·
                <a href="{{ route('blog.index') }}">Blog</a> ·
                {{ $post->title }}
            </div>
            <h1>{{ $post->title }}</h1>
            <p>
                {{ optional($post->published_at)->format('d M Y') }}
                @if($post->category) · {{ $post->category->name }} @endif
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container split">
            <article class="prose">
                @if($post->featured_image)
                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}">
                @endif

                {!! $post->body !!}

                @if($post->tags->isNotEmpty())
                    <div style="margin-top:1.5rem">
                        @foreach($post->tags as $tag)
                            <span class="tag">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="quote" style="margin-top:2rem;border-left-color:var(--teal-600)">
                    <strong>Have a question about your heart health?</strong>
                    <p style="font-style:normal;margin:.5rem 0 0">
                        <a href="{{ route('appointment.create') }}" class="btn btn--primary">Book a Consultation</a>
                    </p>
                </div>
            </article>

            <aside>
                @if($related->isNotEmpty())
                    <div class="form">
                        <h3 style="margin-top:0">Related articles</h3>
                        <ul class="footer__links" style="list-style:none;padding:0">
                            @foreach($related as $item)
                                <li style="margin-bottom:.6rem"><a href="{{ route('blog.show', $item) }}">{{ $item->title }} →</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </section>
@endsection
