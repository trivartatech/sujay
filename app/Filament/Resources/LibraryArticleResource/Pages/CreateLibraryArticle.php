<?php

namespace App\Filament\Resources\LibraryArticleResource\Pages;

use App\Filament\Resources\LibraryArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateLibraryArticle extends CreateRecord
{
    use Translatable;

    protected static string $resource = LibraryArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
                ->visible(fn () => \App\Support\Locale::contentTranslationsEnabled()),
        ];
    }
}
