<?php

namespace App\Filament\Resources\LibraryArticleResource\Pages;

use App\Filament\Resources\LibraryArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListLibraryArticles extends ListRecords
{
    use Translatable;

    protected static string $resource = LibraryArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
                ->visible(fn () => \App\Support\Locale::contentTranslationsEnabled()),
            Actions\CreateAction::make(),
        ];
    }
}
