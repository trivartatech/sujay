<?php

namespace App\Filament\Resources\LibrarySectionResource\Pages;

use App\Filament\Resources\LibrarySectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListLibrarySections extends ListRecords
{
    use Translatable;

    protected static string $resource = LibrarySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
