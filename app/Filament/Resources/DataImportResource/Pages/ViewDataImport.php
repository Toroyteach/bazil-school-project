<?php

namespace App\Filament\Resources\DataImportResource\Pages;

use App\Filament\Resources\DataImportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataImport extends ViewRecord
{
    protected static string $resource = DataImportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
