<?php

namespace App\Filament\Resources\StClassResource\Pages;

use App\Filament\Resources\StClassResource;
use App\Filament\Resources\StClassResource\Widgets\StClassOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStClasses extends ListRecords
{
    protected static string $resource = StClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StClassOverview::class,
        ];
    }
}
