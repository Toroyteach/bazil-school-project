<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataImportResource\Pages;
use App\Filament\Resources\DataImportResource\Pages\StudentUpload;
use App\Filament\Resources\DataImportResource\RelationManagers;
use App\Models\DataImport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataImportResource extends Resource
{
    protected static ?string $model = DataImport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('file_path')
                ->label('Upload Excel File (.xlsx)')
                ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('file_path'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataImports::route('/'),
            'create' => Pages\CreateDataImport::route('/create'),
            'view' => Pages\ViewDataImport::route('/{record}'),
            'edit' => Pages\EditDataImport::route('/{record}/edit'),
        ];
    }

    public static function registerPages(): array
    {
        return [
            'student-upload' => StudentUpload::class,
        ];
    }
}
