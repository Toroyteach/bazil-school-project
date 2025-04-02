<?php

namespace App\Filament\Resources\AcademicProgressResource\Pages;

use App\Filament\Resources\AcademicProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAcademicProgress extends EditRecord
{
    protected static string $resource = AcademicProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
