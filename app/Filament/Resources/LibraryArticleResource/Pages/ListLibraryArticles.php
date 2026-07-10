<?php

namespace App\Filament\Resources\LibraryArticleResource\Pages;

use App\Filament\Resources\LibraryArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLibraryArticles extends ListRecords
{
    protected static string $resource = LibraryArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
