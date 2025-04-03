<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolFeesRelationManager extends RelationManager
{
    protected static string $relationship = 'schoolFees';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('amount_due')
                    ->required()
                    ->numeric()
                    ->step(0.01),
                Forms\Components\TextInput::make('amount_paid')
                    ->required()
                    ->numeric()
                    ->step(0.01),
                Forms\Components\TextInput::make('balance')
                    ->required()
                    ->numeric()
                    ->step(0.01),
                Forms\Components\Select::make('status')
                    ->options([
                        'Paid' => 'Paid',
                        'Partial' => 'Partial',
                        'Unpaid' => 'Unpaid',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('due_date')
                    ->required(),
                Forms\Components\Select::make('payment_method_id')
                    ->relationship('paymentMethod', 'method_name')
                    ->searchable()
                    ->nullable(),
                Forms\Components\Textarea::make('remarks')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('student.name')
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Student'),
                Tables\Columns\TextColumn::make('amount_due')
                    ->money('KES'),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->money('KES'),
                Tables\Columns\TextColumn::make('balance')
                    ->money('KES'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'Paid',
                        'warning' => 'Partial',
                        'danger' => 'Unpaid',
                    ]),
                Tables\Columns\TextColumn::make('due_date')
                    ->date(),
                Tables\Columns\TextColumn::make('paymentMethod.method_name')
                    ->label('Payment Method')
                    ->sortable(),
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
