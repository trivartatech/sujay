@extends('layouts.app')

@section('title', 'Blog — Heart Health & Care')
@section('description', 'Articles on heart health, prevention, and post-operative care from Dr Sujay J.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · Blog</div>
            <h1>Heart Health Blog</h1>
            <p>Guidance on prevention, treatment, and recovery — written for patients and families.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if($categories->isNotEmpty())
                <div style="display:flex;gap:.5rem;flex-wrap:wrap;justify-content:center;margin-bottom:2rem">
                    <a href="{{ route('blog.index') }}" class="btn {{ $activeCategory === '' ? 'btn--primary' : 'btn--ghost' }}">All</a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                           class="btn {{ $activeCategory === $category->slug ? 'btn--primary' : 'btn--ghost' }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            @endif

            @if($posts->isEmpty())
                <p style="text-align:center;color:var(--muted)">No articles published yet. Please check back soon.</p>
            @else
                <div class="grid grid--3">
                    @foreach($posts as $post)
                        @include('blog.partials.card', ['post' => $post])
                    @endforeach
                </div>

                {{ $posts->links() }}
            @endif
        </div>
    </section>
@endsection
