<?php

namespace App\Filament\Resources\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AcademicProgress;
use App\Models\StClass;

class TopPerformingClasses extends BaseWidget
{
    protected function getStats(): array
    {
        $gradeMap = ['A' => 6, 'B' => 5, 'C' => 4, 'D' => 3, 'E' => 2, 'F' => 1];

        $topClasses = AcademicProgress::selectRaw('class_id, AVG(
            CASE grade 
                WHEN "A" THEN 6
                WHEN "B" THEN 5
                WHEN "C" THEN 4
                WHEN "D" THEN 3
                WHEN "E" THEN 2
                WHEN "F" THEN 1
            END
        ) as avg_score')
        ->groupBy('class_id')
        ->orderByDesc('avg_score')
        ->limit(4)
        ->get();

        return $topClasses->map(function ($class, $index) {
            $classModel = StClass::find($class->class_id);
            $teacher = User::where('id', $classModel?->teacher_id)->first();

            return Stat::make(($index === 0 ? '🏆 ' : '') . $classModel?->class_name ?? 'N/A', round($class->avg_score, 2))
                ->description($index === 0 ? "Class Teacher: {$teacher?->name}" : 'Top Performing Class')
                ->descriptionIcon($index === 0 ? 'heroicon-m-trophy' : null);
        })->toArray();
    }
}