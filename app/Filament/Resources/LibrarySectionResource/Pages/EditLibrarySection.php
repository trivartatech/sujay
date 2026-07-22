<?php

namespace App\Filament\Resources\LibrarySectionResource\Pages;

use App\Filament\Resources\LibrarySectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditLibrarySection extends EditRecord
{
    use Translatable;

    protected static string $resource = LibrarySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
