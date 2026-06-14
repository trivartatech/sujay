<a class="card" href="{{ route('blog.show', $post) }}" style="text-decoration:none;color:inherit">
    @if($post->featured_image)
        <img class="card__img" src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
    @endif
    <div class="card__body">
        <div class="card__meta">
            {{ optional($post->published_at)->format('d M Y') }}
            @if($post->category) · {{ $post->category->name }} @endif
        </div>
        <h3>{{ $post->title }}</h3>
        <p>{{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->body), 120) }}</p>
        <span class="card__more">Read article →</span>
    </div>
</a>
