<?php

namespace App\Filament\Resources\StClassResource\Pages;

use App\Filament\Resources\StClassResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStClass extends ViewRecord
{
    protected static string $resource = StClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
