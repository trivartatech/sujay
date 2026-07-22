<?php

namespace App\Filament\Resources\LibrarySectionResource\Pages;

use App\Filament\Resources\LibrarySectionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateLibrarySection extends CreateRecord
{
    use Translatable;

    protected static string $resource = LibrarySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
                ->visible(fn () => \App\Support\Locale::contentTranslationsEnabled()),
        ];
    }
}
