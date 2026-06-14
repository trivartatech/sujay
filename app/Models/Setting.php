<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Simple key/value store for site-wide settings: SEO defaults, homepage
 * stats (years of experience, surgeries performed), contact details, etc.
 * Values are JSON-cast so they can hold scalars, arrays, or objects.
 */
class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'value' => 'json',
        ];
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = Cache::rememberForever("setting.{$key}", fn () => static::query()->where('key', $key)->first());

        return $setting?->value ?? $default;
    }

    public static function set(string $key, mixed $value, ?string $group = null): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value] + ($group ? ['group' => $group] : []),
        );

        Cache::forget("setting.{$key}");

        return $setting;
    }
}
