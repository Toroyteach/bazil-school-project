<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StClassResource\Pages;
use App\Filament\Resources\StClassResource\RelationManagers;
use App\Filament\Resources\StClassResource\Widgets\StClassOverview;
use App\Models\StClass;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StClassResource extends Resource
{
    protected static ?string $model = StClass::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $modelLabel = 'Classes in School';

    protected static ?string $navigationLabel = 'Classes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('class_name')
                    ->required(),
                Forms\Components\TextInput::make('section'),
                Forms\Components\Select::make('class_teacher_id')
                    ->relationship('classTeacher', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                \Filament\Tables\Actions\Action::make('info')
                    ->label('This is the schools Classes, lower to higher classes')
                    ->disabled()
                    ->color('gray')
                    ->icon('heroicon-o-information-circle')
                    ->extraAttributes(['class' => 'text-lg text-gray-500 font-semibold'])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('class_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('section')
                    ->searchable(),
                Tables\Columns\TextColumn::make('students_count')
                    ->searchable(),
                Tables\Columns\TextColumn::make('classTeacher.name')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStClasses::route('/'),
            'create' => Pages\CreateStClass::route('/create'),
            'view' => Pages\ViewStClass::route('/{record}'),
            'edit' => Pages\EditStClass::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StClassOverview::class,
        ];
    }
}
