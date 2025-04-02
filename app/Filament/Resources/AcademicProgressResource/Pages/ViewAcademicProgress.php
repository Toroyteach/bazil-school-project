<?php

namespace App\Filament\Resources\AcademicProgressResource\Pages;

use App\Filament\Resources\AcademicProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAcademicProgress extends ViewRecord
{
    protected static string $resource = AcademicProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
