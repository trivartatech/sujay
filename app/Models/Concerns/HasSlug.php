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
            $source = $model->slugSourceColumn();
            $column = $model->slugColumnName();

            // Only (re)generate when the slug is empty.
            if (blank($model->{$column}) && filled($model->{$source})) {
                $model->{$column} = $model->generateUniqueSlug((string) $model->{$source});
            }
        });
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
