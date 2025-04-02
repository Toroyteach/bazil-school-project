<?php

namespace App\Filament\Resources\AcademicProgressResource\Widgets;

use App\Models\AcademicProgress;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AcademicProgessOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Total academic progress records
            Stat::make('Total Academic Records', AcademicProgress::count())
                ->description('Total student progress records')
                ->descriptionIcon('heroicon-m-clipboard-document'),

            // Progress categorized by status
            Stat::make('Completed Records', AcademicProgress::where('status', 'Completed')->count())
                ->description('Progress entries marked as completed')
                ->descriptionIcon('heroicon-m-check-circle'),

            Stat::make('In-Progress Records', AcademicProgress::where('status', 'In-Progress')->count())
                ->description('Progress entries still ongoing'),
                //->descriptionIcon('heroicon-m-refresh'),

            Stat::make('Pending Records', AcademicProgress::where('status', 'Pending')->count())
                ->description('Pending academic progress entries')
                ->descriptionIcon('heroicon-m-clock'),

            // Progress categorized by type
            Stat::make('Exam Records', AcademicProgress::where('progress_type', 'Exam')->count())
                ->description('Records from exams')
                ->descriptionIcon('heroicon-m-academic-cap'),

            Stat::make('Project Records', AcademicProgress::where('progress_type', 'Project')->count())
                ->description('Records from projects')
                ->descriptionIcon('heroicon-m-light-bulb'),

            Stat::make('Assignment Records', AcademicProgress::where('progress_type', 'Assignment')->count())
                ->description('Records from assignments')
                ->descriptionIcon('heroicon-m-document-text'),

            // Academic performance summary
            Stat::make('Top Grade (A)', AcademicProgress::where('grade', 'A')->count())
                ->description('Students achieving A grades')
                ->descriptionIcon('heroicon-m-star'),

            Stat::make('Failing Grades (D, E, F)', AcademicProgress::whereIn('grade', ['D', 'E', 'F'])->count())
                ->description('Students with poor performance')
                ->descriptionIcon('heroicon-m-exclamation-circle'),
        ];
    }
}