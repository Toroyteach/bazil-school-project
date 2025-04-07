<?php

namespace App\Filament\Resources\DataImportResource\Pages;

use App\Imports\StudentsImport;
use Filament\Pages\Page;
use Filament\Forms;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class StudentUpload extends Page
{
    protected static string $resource = \App\Filament\Resources\DataImportResource::class;
    protected static string $view = 'filament.resources.data-import-resource.pages.student-upload';

    public $file;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('file')
                ->acceptedFileTypes(['.xlsx'])
                ->required()
                ->label('Upload Student Excel File'),
        ];
    }

    public function upload(): void
    {
        $path = $this->file->store('data-imports');
        Excel::import(new StudentsImport, $path);
        Notification::make()->title('Student Data Imported')->success()->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Pages\Actions\Action::make('Download Sample')
                ->url(route('students.sample'))
                ->icon('heroicon-o-download'),
        ];
    }
}