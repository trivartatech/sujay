@extends('layouts.app')

@section('title', 'Heart Health Library')
@section('description', 'Trusted information to help you understand, prevent and manage heart and lung conditions.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · Heart Health Library</div>
            <h1>Heart Health Library</h1>
            <p>Trusted information to help you understand, prevent and manage heart conditions.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if($sections->isEmpty())
                <p style="text-align:center;color:var(--muted)">Library content is being prepared. Please check back soon.</p>
            @else
                <div class="grid grid--3">
                    @foreach($sections as $section)
                        <a class="lib-card" href="{{ route('library.section', $section) }}">
                            @if($section->image)
                                <img class="lib-card__img" src="{{ asset('storage/'.$section->image) }}" alt="{{ $section->title }}" loading="lazy">
                            @else
                                <div class="lib-card__img lib-card__img--ph"><x-ui-icon name="book" style="width:40px;height:40px" /></div>
                            @endif
                            <div class="lib-card__body">
                                <h3>{{ $section->title }}</h3>
                                <p>{{ $section->description }}</p>
                                @if($section->articles_count)
                                    <p style="margin-top:.6rem"><span class="tag">{{ $section->articles_count }} {{ \Illuminate\Support\Str::plural('article', $section->articles_count) }}</span></p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
