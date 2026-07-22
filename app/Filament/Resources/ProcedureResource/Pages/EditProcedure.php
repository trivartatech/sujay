<?php

namespace App\Filament\Resources\ProcedureResource\Pages;

use App\Filament\Resources\ProcedureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditProcedure extends EditRecord
{
    use Translatable;

    protected static string $resource = ProcedureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
                ->visible(fn () => \App\Support\Locale::contentTranslationsEnabled()),
            Actions\DeleteAction::make(),
        ];
    }
}
