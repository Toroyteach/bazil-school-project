<?php

namespace App\Filament\Resources\Widgets\Charts;

use Filament\Widgets\ChartWidget;
use App\Models\SchoolFee;

class FeeProgressChart extends ChartWidget
{
    protected static ?string $heading = 'School Fee Progress';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Fee Status',
                    'data' => [
                        SchoolFee::where('status', 'Paid')->count(),
                        SchoolFee::where('status', 'Partial')->count(),
                        SchoolFee::where('status', 'Unpaid')->count(),
                    ],
                    'backgroundColor' => ['#22c55e', '#facc15', '#ef4444'],
                ],
            ],
            'labels' => ['Paid', 'Partial', 'Unpaid'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}