<?php

namespace App\Filament\Resources\DataImportResource\Pages;

use App\Filament\Resources\DataImportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataImport extends EditRecord
{
    protected static string $resource = DataImportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
