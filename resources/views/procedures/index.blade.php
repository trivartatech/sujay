@extends('layouts.app')

@section('title', 'Procedures & Services')
@section('description', 'Cardiac surgical procedures offered by Dr Sujay J — CABG, valve replacement, angioplasty, pediatric cardiac surgery and more.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · Procedures</div>
            <h1>Procedures &amp; Services</h1>
            <p>Comprehensive surgical care across the full spectrum of cardiac conditions.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if($procedures->isEmpty())
                <p style="text-align:center;color:var(--muted)">Procedures will be listed here soon. Please <a href="{{ route('contact') }}">contact us</a> for details.</p>
            @else
                <div class="grid grid--3">
                    @foreach($procedures as $procedure)
                        <a class="card" href="{{ route('procedures.show', $procedure) }}" style="text-decoration:none;color:inherit">
                            @if($procedure->image)
                                <img class="card__img" src="{{ asset('storage/'.$procedure->image) }}" alt="{{ $procedure->title }}" loading="lazy">
                            @endif
                            <div class="card__body">
                                <h3>{{ $procedure->title }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit($procedure->summary, 120) }}</p>
                                <span class="card__more">Learn more →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
