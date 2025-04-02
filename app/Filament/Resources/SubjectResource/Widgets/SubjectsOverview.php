<?php

namespace App\Filament\Resources\SubjectResource\Widgets;

use App\Models\Subject;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubjectsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Subjects', Subject::count())
                ->description('Total number of subjects available')
                ->descriptionIcon('heroicon-m-book-open'),

            Stat::make('Subjects with Classes', Subject::whereNotNull('class_id')->count())
                ->description('Subjects assigned to classes')
                ->descriptionIcon('heroicon-m-clipboard-document-check'),
        ];
    }
}
