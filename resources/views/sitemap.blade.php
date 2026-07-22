<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        @isset($url['lastmod'])<lastmod>{{ $url['lastmod'] }}</lastmod>@endisset
        <priority>{{ $url['priority'] }}</priority>
{{-- Only worth emitting when there is actually more than one language to point at --}}
@if(count($url['alternates'] ?? []) > 1)
@foreach($url['alternates'] as $altLocale => $altUrl)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ $altUrl }}"/>
@endforeach
@isset($url['alternates']['en'])
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $url['alternates']['en'] }}"/>
@endisset
@endif
    </url>
@endforeach
</urlset>
