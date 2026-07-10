@extends('layouts.app')

@section('title', 'Frequently Asked Questions')
@section('description', 'Answers to common questions about consultations, cardiac tests, treatments, and appointments with Dr. Sujay J.')

@push('head')
    @if($faqs->isNotEmpty())
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqs->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq->question,
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq->answer)],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endif
@endpush

@section('content')
    <section class="page-band">
        <div class="container">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> · FAQs</div>
            <h1>Frequently Asked Questions</h1>
            <p>Answers to the questions patients ask most often.</p>
        </div>
    </section>

    <section class="section">
        <div class="container" style="max-width:840px">
            @if($faqs->isEmpty())
                <p style="text-align:center;color:var(--muted)">FAQs will be published here soon.</p>
            @else
                @foreach($faqs as $faq)
                    <details class="faq" @if($loop->first) open @endif>
                        <summary>{{ $faq->question }}</summary>
                        <div class="faq__answer">{!! nl2br(e($faq->answer)) !!}</div>
                    </details>
                @endforeach
            @endif

            <div style="text-align:center;margin-top:2.5rem">
                <p style="color:var(--muted)">Still have a question?</p>
                <a href="{{ route('contact') }}" class="btn btn--primary">Contact Us</a>
                <a href="https://wa.me/{{ config('site.whatsapp') }}" class="btn btn--whatsapp" target="_blank" rel="noopener">Ask on WhatsApp</a>
            </div>
        </div>
    </section>
@endsection
