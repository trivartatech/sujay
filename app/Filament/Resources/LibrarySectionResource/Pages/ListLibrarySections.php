<?php

namespace App\Filament\Resources\LibrarySectionResource\Pages;

use App\Filament\Resources\LibrarySectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLibrarySections extends ListRecords
{
    protected static string $resource = LibrarySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
