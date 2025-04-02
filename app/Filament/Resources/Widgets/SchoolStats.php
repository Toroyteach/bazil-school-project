<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;
use App\Models\User;
use App\Models\OTP;
use App\Models\SchoolFee;
use App\Models\Subject;

class SchoolStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('All enrolled students')
                ->descriptionIcon('heroicon-m-user-group'),

            Stat::make('New Enrollments', Student::whereMonth('created_at', now()->month)->count())
                ->description('Students enrolled this month')
                ->descriptionIcon('heroicon-m-user-plus'),

            Stat::make('Total Teachers', User::where('role', 'teacher')->count())
                ->description('All active teachers')
                ->descriptionIcon('heroicon-m-academic-cap'),

            Stat::make('Total Staff', User::count())
                ->description('Teachers & admins combined')
                ->descriptionIcon('heroicon-m-building-office'),

            Stat::make('OTP Requests', OTP::count())
                ->description('Total login verification requests')
                ->descriptionIcon('heroicon-m-key'),

            Stat::make('Total Subjects', Subject::count())
                ->description('Available school subjects')
                ->descriptionIcon('heroicon-m-book-open'),
        ];
    }
}