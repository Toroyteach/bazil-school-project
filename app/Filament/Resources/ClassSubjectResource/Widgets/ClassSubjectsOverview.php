<?php

namespace App\Filament\Resources\ClassSubjectResource\Widgets;

use App\Models\ClassSubject;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClassSubjectsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Subjects Assigned', ClassSubject::count())
                ->description('Subjects assigned to classes')
                ->descriptionIcon('heroicon-m-book-open'),

            Stat::make('Total Teachers Assigned', ClassSubject::distinct('teacher_id')->count())
                ->description('Teachers handling subjects')
                ->descriptionIcon('heroicon-m-user-group'),

            Stat::make('Classes with Subjects', ClassSubject::distinct('class_id')->count())
                ->description('Classes assigned subjects')
                ->descriptionIcon('heroicon-m-academic-cap'),

            Stat::make('Most Assigned Subject', ClassSubject::select('subject_name')
                ->groupBy('subject_name')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(1)
                ->value('subject_name') ?? 'N/A')
                ->description('Frequently assigned subject')
                ->descriptionIcon('heroicon-m-star'),
        ];
    }
}
