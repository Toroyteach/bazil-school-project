<?php

namespace App\Filament\Resources\DataImportResource\Pages;

use App\Filament\Resources\DataImportResource;
use App\Imports\StudentsImport;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class CreateDataImport extends CreateRecord
{
    protected static string $resource = DataImportResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'uploaded';
        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        Excel::import(new StudentsImport, Storage::path($record->file_path));
        $record->update(['status' => 'imported']);
    }
}
