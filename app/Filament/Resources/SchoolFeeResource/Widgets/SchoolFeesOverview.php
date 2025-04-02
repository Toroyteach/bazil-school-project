<?php

namespace App\Filament\Resources\SchoolFeeResource\Widgets;

use App\Models\SchoolFee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SchoolFeesOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Fees Due', SchoolFee::sum('amount_due'))
                ->description('Total fees due across all students')
                ->descriptionIcon('heroicon-m-credit-card'),

            Stat::make('Total Fees Paid', SchoolFee::sum('amount_paid'))
                ->description('Total fees paid by all students')
                ->descriptionIcon('heroicon-m-check-circle'),

            Stat::make('Total Balance', SchoolFee::sum('balance'))
                ->description('Total outstanding balance')
                ->descriptionIcon('heroicon-m-exclamation-circle'),

            Stat::make('Students with Unpaid Fees', SchoolFee::where('status', 'Unpaid')->count())
                ->description('Total number of unpaid fees')
                ->descriptionIcon('heroicon-m-x-circle'),

            Stat::make('Students with Partial Payments', SchoolFee::where('status', 'Partial')->count())
                ->description('Total number of partial payments')
                ->descriptionIcon('heroicon-m-credit-card'),
        ];
    }
}
