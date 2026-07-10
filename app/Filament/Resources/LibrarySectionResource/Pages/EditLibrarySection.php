<?php

namespace App\Filament\Resources\LibrarySectionResource\Pages;

use App\Filament\Resources\LibrarySectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLibrarySection extends EditRecord
{
    protected static string $resource = LibrarySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
