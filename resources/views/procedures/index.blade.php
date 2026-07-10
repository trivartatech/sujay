@extends('layouts.app')

@section('title', 'Services')
@section('description', 'Comprehensive cardiac and pulmonary care by Dr. Sujay J — preventive cardiology, coronary artery disease, heart failure, arrhythmia, valvular disease, interventional cardiology and pulmonary care.')

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · Services</div>
            <h1>Comprehensive Cardiac Care</h1>
            <p>Evidence-based care across the full spectrum of heart and lung conditions.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if($procedures->isEmpty())
                <p style="text-align:center;color:var(--muted)">Services will be listed here soon. Please <a href="{{ route('contact') }}">contact us</a> for details.</p>
            @else
                <div class="grid grid--3">
                    @foreach($procedures as $procedure)
                        <a class="card" href="{{ route('services.show', $procedure) }}">
                            @if($procedure->image)
                                <img class="card__img" src="{{ asset('storage/'.$procedure->image) }}" alt="{{ $procedure->title }}" loading="lazy">
                            @endif
                            <div class="card__body">
                                <span class="care__icon" style="margin:0 0 .8rem;width:40px;height:40px">
                                    <x-icon :name="$procedure->icon ?: 'heart-pulse'" />
                                </span>
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
