<?php

namespace App\Filament\Resources\AcademicProgressResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Total users
            Stat::make('Total Users', User::count())
                ->description('Total registered users')
                ->descriptionIcon('heroicon-m-users'),

            // Users by role
            Stat::make('Total Admins', User::where('role', 'admin')->count())
                ->description('Number of administrators')
                ->descriptionIcon('heroicon-m-shield-check'),

            Stat::make('Total Teachers', User::where('role', 'teacher')->count())
                ->description('Number of teaching staff')
                ->descriptionIcon('heroicon-m-academic-cap'),

            // Recently added users
            Stat::make('New Users This Month', User::whereMonth('created_at', now()->month)->count())
                ->description('Users who joined this month')
                ->descriptionIcon('heroicon-m-calendar'),
        ];
    }
}
