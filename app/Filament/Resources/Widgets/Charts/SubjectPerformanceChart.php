<?php

namespace App\Filament\Resources\Widgets\Charts;

use App\Models\Subject;
use Filament\Widgets\ChartWidget;
use App\Models\AcademicProgress;

class SubjectPerformanceChart extends ChartWidget
{
    protected static ?string $heading = 'Subject Performance';
    protected static ?string $chartType = 'bar';

    protected function getData(): array
    {
        $data = AcademicProgress::selectRaw('subject_id, AVG(
            CASE grade 
                WHEN "A" THEN 6
                WHEN "B" THEN 5
                WHEN "C" THEN 4
                WHEN "D" THEN 3
                WHEN "E" THEN 2
                WHEN "F" THEN 1
            END
        ) as avg_score')
            ->groupBy('subject_id')
            ->orderByDesc('avg_score')
            ->limit(5)
            ->get()
            ->mapWithKeys(fn($row) => [Subject::find($row->subject_id)?->title ?? 'Unknown' => $row->avg_score]);

        return [
            'datasets' => [
                [
                    'label' => 'Avg Performance',
                    'data' => array_values($data->toArray()),
                    'backgroundColor' => '#10b981',
                ],
            ],
            'labels' => array_keys($data->toArray()),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}