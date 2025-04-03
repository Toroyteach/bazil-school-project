<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassSubjectRelationManager extends RelationManager
{
    protected static string $relationship = 'classSubject';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subject_code')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Select::make('class_id')
                    ->relationship('st_classes', 'name')
                    ->searchable()
                    ->nullable(),
                Forms\Components\Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('subject_name')
            ->columns([
                Tables\Columns\TextColumn::make('subject_name'),
                Tables\Columns\TextColumn::make('subject_code'),
                Tables\Columns\TextColumn::make('st_class.class_name')
                    ->label('Class'),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->label('Teacher'),
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
