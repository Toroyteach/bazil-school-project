<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardIntroduction;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Resources\Widgets\SchoolStats;
use App\Filament\Resources\Widgets\Charts\FeeProgressChart;
use App\Filament\Resources\Widgets\Charts\StudentEnrollmentChart;
use App\Filament\Resources\Widgets\Charts\SubjectPerformanceChart;
use App\Filament\Resources\Widgets\TopPerformingClasses;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            DashboardIntroduction::class,
            SchoolStats::class,
            FeeProgressChart::class,
            StudentEnrollmentChart::class,
            SubjectPerformanceChart::class,
            TopPerformingClasses::class,
        ];
    }

    public function getColumns(): int|string|array
    {
        return [
            'default' => 2,
            'sm' => 2,
            'lg' => 2,
        ];
    }
}