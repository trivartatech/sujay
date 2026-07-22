<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Converts the editable content columns to spatie/laravel-translatable's JSON
 * shape: "Some title" becomes {"en": "Some title"}.
 *
 * Data-only on purpose. SQLite is dynamically typed and does not enforce
 * VARCHAR lengths, so a 7-language JSON blob fits the existing columns without
 * an ALTER TABLE — which on SQLite means rebuilding tables that carry foreign
 * keys and composite unique indexes. Not worth the risk on live data.
 * (If this ever moves to MySQL, widen these columns to JSON/TEXT first.)
 */
return new class extends Migration
{
    /** @var array<string, list<string>> */
    private const TRANSLATABLE = [
        'posts' => ['title', 'excerpt', 'body', 'meta_title', 'meta_description'],
        'library_sections' => ['title', 'description', 'body', 'meta_title', 'meta_description'],
        'library_articles' => ['title', 'excerpt', 'body', 'meta_title', 'meta_description'],
        'procedures' => ['title', 'summary', 'body', 'meta_title', 'meta_description'],
        'faqs' => ['question', 'answer'],
    ];

    public function up(): void
    {
        $this->convert(fn (string $value) => json_encode(['en' => $value], JSON_UNESCAPED_UNICODE), wrap: true);
    }

    public function down(): void
    {
        $this->convert(fn (string $value) => json_decode($value, true)['en'] ?? '', wrap: false);
    }

    /**
     * Walks every translatable column and rewrites values that are not already
     * in the target shape, so re-running is a no-op rather than double-wrapping.
     */
    private function convert(callable $transform, bool $wrap): void
    {
        foreach (self::TRANSLATABLE as $table => $columns) {
            DB::table($table)->orderBy('id')->chunkById(100, function ($rows) use ($table, $columns, $transform, $wrap) {
                foreach ($rows as $row) {
                    $changes = [];

                    foreach ($columns as $column) {
                        $value = $row->{$column};

                        if ($value === null || $value === '') {
                            continue;
                        }

                        if ($this->isTranslationMap($value) === $wrap) {
                            continue;
                        }

                        $changes[$column] = $transform($value);
                    }

                    if ($changes !== []) {
                        DB::table($table)->where('id', $row->id)->update($changes);
                    }
                }
            });
        }
    }

    /**
     * True when the value already looks like {"en": "...", "kn": "..."} rather
     * than plain text that merely happens to start with a brace.
     */
    private function isTranslationMap(string $value): bool
    {
        if (! str_starts_with(ltrim($value), '{')) {
            return false;
        }

        $decoded = json_decode($value, true);

        if (! is_array($decoded) || $decoded === []) {
            return false;
        }

        $locales = array_keys(config('site.locales', ['en' => 'English']));

        foreach (array_keys($decoded) as $key) {
            if (! in_array($key, $locales, true)) {
                return false;
            }
        }

        return true;
    }
};
