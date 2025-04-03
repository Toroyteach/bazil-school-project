<?php

namespace App\Filament\Resources\SchoolFeeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StClassRelationManager extends RelationManager
{
    protected static string $relationship = 'stClass';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('class_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('section')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('students_count')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('class_teacher_id')
                    ->relationship('classTeacher', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('class_name')
            ->columns([
                Tables\Columns\TextColumn::make('class_name'),
                Tables\Columns\TextColumn::make('section'),
                Tables\Columns\TextColumn::make('students_count'),
                Tables\Columns\TextColumn::make('classTeacher.name')
                    ->label('Class Teacher'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
