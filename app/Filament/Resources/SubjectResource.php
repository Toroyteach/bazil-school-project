<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Filament\Resources\SubjectResource\RelationManagers\AcademicProgressRelationManager;
use App\Filament\Resources\SubjectResource\RelationManagers\StClassesRelationManager;
use App\Filament\Resources\SubjectResource\Widgets\SubjectsOverview;
use App\Models\StClass;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $modelLabel = 'Subjects in School';

    protected static ?string $navigationLabel = 'Subjects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('summary')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Select::make('class_id')
                    ->label('Class')
                    ->options(StClass::pluck('class_name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                \Filament\Tables\Actions\Action::make('info')
                    ->label('Subjects across the entire school\'s classes')
                    ->disabled()
                    ->color('gray')
                    ->icon('heroicon-o-information-circle')
                    ->extraAttributes(['class' => 'text-lg text-gray-500 font-semibold'])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('st_class.class_name')->label('Class Name')->sortable()->searchable(),
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
            StClassesRelationManager::class,
            AcademicProgressRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'view' => Pages\ViewSubject::route('/{record}'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            SubjectsOverview::class,
        ];
    }
}
