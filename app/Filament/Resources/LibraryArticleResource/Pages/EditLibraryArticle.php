<?php

namespace App\Filament\Resources\LibraryArticleResource\Pages;

use App\Filament\Resources\LibraryArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLibraryArticle extends EditRecord
{
    protected static string $resource = LibraryArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
