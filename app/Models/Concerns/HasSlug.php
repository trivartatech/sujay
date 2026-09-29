<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Auto-generates a unique, URL-safe slug from a source column when the model
 * is created (and when the source changes, if the slug was not set manually).
 *
 * Models may override:
 *   - protected string $slugSource  (default: 'title')
 *   - protected string $slugColumn  (default: 'slug')
 */
trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(function (Model $model) {
            $column = $model->slugColumnName();
            $value = $model->slugSourceValue();

            if (blank($model->{$column})) {
                // No slug given — generate a unique one from the source text.
                if (filled($value)) {
                    $model->{$column} = $model->generateUniqueSlug($value);
                }

                return;
            }

            // A slug was set by hand. Normalise it so a pasted path, stray
            // slashes or spaces can never reach the DB and double up the route
            // (e.g. "/heart-conditions/cardiomyopathy/" → "heart-conditions-cardiomyopathy").
            // Str::slug is idempotent on already-clean slugs, so existing URLs
            // never move. If it sanitises to nothing (e.g. a non-Latin slug),
            // fall back to generating from the source text.
            $clean = Str::slug((string) $model->{$column});
            $model->{$column} = $clean !== '' ? $clean : $model->generateUniqueSlug($value);
        });
    }

    /**
     * Always slug from the English text on translatable models — Str::slug()
     * strips non-Latin scripts, so slugging a Kannada title would yield an
     * empty slug. URLs stay English across every locale by design.
     */
    protected function slugSourceValue(): string
    {
        $source = $this->slugSourceColumn();

        if (method_exists($this, 'getTranslation')) {
            $english = (string) $this->getTranslation($source, 'en', false);

            if ($english !== '') {
                return $english;
            }
        }

        return (string) $this->{$source};
    }

    protected function slugSourceColumn(): string
    {
        return property_exists($this, 'slugSource') ? $this->slugSource : 'title';
    }

    protected function slugColumnName(): string
    {
        return property_exists($this, 'slugColumn') ? $this->slugColumn : 'slug';
    }

    protected function generateUniqueSlug(string $value): string
    {
        $base = Str::slug($value);
        $slug = $base;
        $column = $this->slugColumnName();
        $i = 2;

        while (
            static::query()
                ->where($column, $slug)
                ->when($this->exists, fn ($q) => $q->whereKeyNot($this->getKey()))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return $this->slugColumnName();
    }
}
