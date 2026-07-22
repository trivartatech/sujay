<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class LibraryArticle extends Model
{
    use HasSlug, HasTranslations;

    /**
     * Stored as JSON per locale; reading returns the active locale
     * and falls back to English when a translation is missing.
     *
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'excerpt',
        'body',
        'meta_title',
        'meta_description',
    ];

    protected $fillable = [
        'library_section_id',
        'title',
        'slug',
        'excerpt',
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

    /**
     * @return BelongsTo<LibrarySection, $this>
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(LibrarySection::class, 'library_section_id');
    }

    /**
     * @param  Builder<LibraryArticle>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }
}
