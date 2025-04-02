<?php

namespace App\Filament\Resources\AcademicProgressResource\Pages;

use App\Filament\Resources\AcademicProgressResource;
use App\Filament\Resources\AcademicProgressResource\Widgets\AcademicProgessOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAcademicProgress extends ListRecords
{
    protected static string $resource = AcademicProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AcademicProgessOverview::class,
        ];
    }
}
