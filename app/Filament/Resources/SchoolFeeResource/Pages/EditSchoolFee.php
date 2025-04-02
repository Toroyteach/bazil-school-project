<?php

namespace App\Filament\Resources\SchoolFeeResource\Pages;

use App\Filament\Resources\SchoolFeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolFee extends EditRecord
{
    protected static string $resource = SchoolFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
