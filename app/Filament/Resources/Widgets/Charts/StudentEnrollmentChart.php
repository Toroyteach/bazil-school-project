<?php

namespace App\Filament\Resources\Widgets\Charts;

use Filament\Widgets\ChartWidget;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentEnrollmentChart extends ChartWidget
{
    protected static ?string $heading = 'New Student Enrollments';
    protected static ?string $chartType = 'bar';

    protected function getData(): array
    {
        $data = Student::selectRaw("strftime('%m', created_at) as month, COUNT(*) as count")
            ->groupBy(DB::raw("strftime('%m', created_at)"))
            ->orderBy('month')
            ->pluck('count', 'month');

        return [
            'datasets' => [
                [
                    'label' => 'New Enrollments',
                    'data' => array_values($data->toArray()),
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => array_map(fn($m) => date('F', mktime(0, 0, 0, (int) $m, 1)), array_keys($data->toArray())),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}