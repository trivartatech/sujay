<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'icon',
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
     * @param  Builder<Procedure>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }

    /**
     * Line-art care icon extracted from the design, by slug
     * (public/images/care/{slug}.png). Falls back to null so the view can
     * use the inline SVG icon component instead.
     */
    public function getCareIconUrlAttribute(): ?string
    {
        $path = 'images/care/'.$this->slug.'.png';

        return is_file(public_path($path)) ? asset($path).'?v='.filemtime(public_path($path)) : null;
    }
}
