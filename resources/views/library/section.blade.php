@extends('layouts.app')

@section('title', $section->meta_title ?: $section->title)
@section('description', $section->meta_description ?: $section->description)

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> ·
                <a href="{{ route('library.index') }}">Heart Health Library</a> ·
                {{ $section->title }}
            </div>
            <h1>{{ $section->title }}</h1>
            @if($section->description)<p>{{ $section->description }}</p>@endif
        </div>
    </section>

    <section class="section">
        <div class="container split split--start">
            <div class="prose" style="max-width:none">
                @if($section->image)
                    <img src="{{ asset('storage/'.$section->image) }}" alt="{{ $section->title }}">
                @endif

                @if($section->body)
                    {!! $section->body !!}
                @endif

                <h2 style="margin-top:2rem">Topics in this section</h2>

                @if($articles->isEmpty())
                    <p style="color:var(--muted)">Articles for this section are coming soon.</p>
                @else
                    <div class="grid grid--2">
                        @foreach($articles as $article)
                            <a class="card" href="{{ route('library.article', [$section, $article]) }}">
                                @if($article->image)
                                    <img class="card__img" src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" loading="lazy">
                                @endif
                                <div class="card__body">
                                    <h3>{{ $article->title }}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit($article->excerpt ?: strip_tags($article->body), 110) }}</p>
                                    <span class="card__more">Read more →</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <aside>
                <div class="form">
                    <h3 style="margin-top:0">Other sections</h3>
                    <ul class="footer__links" style="list-style:none;padding:0">
                        @foreach($otherSections as $item)
                            <li style="margin-bottom:.6rem"><a href="{{ route('library.section', $item) }}">{{ $item->title }} →</a></li>
                        @endforeach
                    </ul>
                    <a href="{{ route('appointment.create') }}" class="btn btn--red" style="margin-top:.8rem;width:100%">Request Consultation</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
