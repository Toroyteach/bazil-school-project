<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Total number of enrolled students')
                ->descriptionIcon('heroicon-m-users'),

            Stat::make('Male Students', Student::where('gender', 'Male')->count())
                ->description('Total male students')
                ->descriptionIcon('heroicon-m-user-circle'),

            Stat::make('Female Students', Student::where('gender', 'Female')->count())
                ->description('Total female students')
                ->descriptionIcon('heroicon-m-user-circle'),

            Stat::make('New Admissions', Student::whereYear('admission_date', now()->year)->count())
                ->description('Students admitted this year')
                ->descriptionIcon('heroicon-m-academic-cap'),
        ];
    }
}
