<?php

namespace App\Filament\Resources\ClassSubjectResource\Pages;

use App\Filament\Resources\ClassSubjectResource;
use App\Filament\Resources\ClassSubjectResource\Widgets\ClassSubjectsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassSubjects extends ListRecords
{
    protected static string $resource = ClassSubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ClassSubjectsOverview::class,
        ];
    }
}
