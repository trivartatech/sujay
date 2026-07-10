<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class LibrarySection extends Model
{
    use HasSlug;

    /** Cache key for the header dropdown (see AppServiceProvider). */
    public const NAV_CACHE_KEY = 'nav.library_sections';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'image',
        'is_published',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        $bust = fn () => Cache::forget(self::NAV_CACHE_KEY);

        static::saved($bust);
        static::deleted($bust);
    }

    /**
     * @return HasMany<LibraryArticle, $this>
     */
    public function articles(): HasMany
    {
        return $this->hasMany(LibraryArticle::class);
    }

    /**
     * @return HasMany<LibraryArticle, $this>
     */
    public function publishedArticles(): HasMany
    {
        return $this->articles()->where('is_published', true)->orderBy('sort_order');
    }

    /**
     * @param  Builder<LibrarySection>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }
}
