<?php

namespace App\Filament\Resources\StClassResource\Widgets;

use App\Models\StClass;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StClassOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Classes', StClass::count())
                ->description('Total number of classes')
                ->descriptionIcon('heroicon-m-academic-cap'),

            Stat::make('Total Students', StClass::sum('students_count'))
                ->description('Total students across all classes')
                ->descriptionIcon('heroicon-m-user-group'),

            Stat::make('Average Students per Class', round(StClass::avg('students_count')))
                ->description('Average students per class')
                ->descriptionIcon('heroicon-m-chart-bar'),

            Stat::make('Classes with Assigned Teachers', StClass::whereNotNull('class_teacher_id')->count())
                ->description('Classes with teacher assigned')
                ->descriptionIcon('heroicon-m-user'),
        ];
    }
}
