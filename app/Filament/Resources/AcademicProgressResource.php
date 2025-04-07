<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicProgressResource\Pages;
use App\Filament\Resources\AcademicProgressResource\RelationManagers;
use App\Filament\Resources\AcademicProgressResource\Widgets\AcademicProgessOverview;
use App\Filament\Resources\AcademicProgressResource\RelationManagers\SubjectRelationManager;
use App\Filament\Resources\AcademicProgressResource\RelationManagers\StClassRelationManager;
use App\Filament\Resources\AcademicProgressResource\RelationManagers\StudentRelationManager;
use App\Models\AcademicProgress;
use App\Models\StClass;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AcademicProgressResource extends Resource
{
    protected static ?string $model = AcademicProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $modelLabel = 'Students Academic Progress';

    protected static ?string $navigationLabel = 'Academic Progess';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'first_name  ')
                    ->required(),
                Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'title')
                    ->required(),
                    Forms\Components\Select::make('class_id')
                    ->label('Class')
                    ->options(StClass::pluck('class_name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('progress_type')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('grade'),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('term')
                    ->required(),
                Forms\Components\TextInput::make('academic_year')
                    ->required(),
                Forms\Components\DatePicker::make('date_recorded')
                    ->required(),
                Forms\Components\Textarea::make('teacher_comments')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.first_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stClass.class_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('progress_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('term')
                    ->searchable(),
                Tables\Columns\TextColumn::make('academic_year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_recorded')
                    ->date()
                    ->sortable(),
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
            StClassRelationManager::class,
            StudentRelationManager::class,
            SubjectRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcademicProgress::route('/'),
            'create' => Pages\CreateAcademicProgress::route('/create'),
            'view' => Pages\ViewAcademicProgress::route('/{record}'),
            'edit' => Pages\EditAcademicProgress::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            AcademicProgessOverview::class,
        ];
    }
}