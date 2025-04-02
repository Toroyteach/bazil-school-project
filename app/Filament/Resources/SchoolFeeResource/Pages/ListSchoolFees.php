<?php

namespace App\Filament\Resources\SchoolFeeResource\Pages;

use App\Filament\Resources\SchoolFeeResource;
use App\Filament\Resources\SchoolFeeResource\Widgets\SchoolFeesOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolFees extends ListRecords
{
    protected static string $resource = SchoolFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SchoolFeesOverview::class,
        ];
    }
}
