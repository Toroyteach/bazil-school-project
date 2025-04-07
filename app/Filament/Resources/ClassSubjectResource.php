<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassSubjectResource\Pages;
use App\Filament\Resources\ClassSubjectResource\RelationManagers;
use App\Filament\Resources\ClassSubjectResource\Widgets\ClassSubjectsOverview;
use App\Filament\Resources\ClassSubjectResource\RelationManagers\TeacherRelationManager;
use App\Filament\Resources\ClassSubjectResource\RelationManagers\StClassRelationManager;
use App\Models\ClassSubject;
use App\Models\StClass;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassSubjectResource extends Resource
{
    protected static ?string $model = ClassSubject::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $modelLabel = 'Class Subjects Students Enroled';

    protected static ?string $navigationLabel = 'Class Subjects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject_name')
                    ->required(),
                Forms\Components\TextInput::make('subject_code')
                    ->required(),
                Forms\Components\Select::make('class_id')
                    ->label('Class')
                    ->options(StClass::pluck('class_name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('teacher_id')
                    ->relationship('teacher', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                \Filament\Tables\Actions\Action::make('info')
                    ->label('Classes that the students will be enrolled in')
                    ->disabled()
                    ->color('gray')
                    ->icon('heroicon-o-information-circle')
                    ->extraAttributes(['class' => 'text-lg text-gray-500 font-semibold'])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('subject_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('st_class.class_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            TeacherRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassSubjects::route('/'),
            'create' => Pages\CreateClassSubject::route('/create'),
            'view' => Pages\ViewClassSubject::route('/{record}'),
            'edit' => Pages\EditClassSubject::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ClassSubjectsOverview::class,
        ];
    }
}
