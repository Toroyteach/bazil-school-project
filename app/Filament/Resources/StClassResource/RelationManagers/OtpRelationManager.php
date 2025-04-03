<?php

namespace App\Filament\Resources\StClassResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OtpRelationManager extends RelationManager
{
    protected static string $relationship = 'otp';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone_number')
                    ->required()
                    ->tel()
                    ->maxLength(15),
                Forms\Components\TextInput::make('otp_code')
                    ->required()
                    ->maxLength(6),
                Forms\Components\DateTimePicker::make('expires_at')
                    ->required(),
                Forms\Components\Toggle::make('is_verified')
                    ->required(),
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'first_name')
                    ->required(),
                Forms\Components\Select::make('class_id')
                    ->relationship('stClass', 'class_name')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('phone_number')
            ->columns([
                Tables\Columns\TextColumn::make('phone_number')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('otp_code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expires_at')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\BooleanColumn::make('is_verified'),
                Tables\Columns\TextColumn::make('student.first_name')
                    ->sortable()
                    ->label('Student'),
                Tables\Columns\TextColumn::make('stClass.class_name')
                    ->sortable()
                    ->label('Class'),
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
