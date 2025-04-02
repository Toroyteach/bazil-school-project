<?php

namespace App\Filament\Resources\SchoolFeeResource\Pages;

use App\Filament\Resources\SchoolFeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSchoolFee extends ViewRecord
{
    protected static string $resource = SchoolFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
