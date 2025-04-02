<?php

namespace App\Filament\Resources\StClassResource\Pages;

use App\Filament\Resources\StClassResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStClass extends EditRecord
{
    protected static string $resource = StClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
