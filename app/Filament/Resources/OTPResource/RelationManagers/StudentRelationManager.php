<?php

namespace App\Filament\Resources\OTPResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentRelationManager extends RelationManager
{
    protected static string $relationship = 'student';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('middle_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Other' => 'Other',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('dob')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('postal_code')
                    ->maxLength(20),
                Forms\Components\TextInput::make('parent_phone_1')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('parent_phone_2')
                    ->maxLength(15),
                Forms\Components\TextInput::make('parent_email_1')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('parent_email_2')
                    ->email()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('admission_date')
                    ->required(),
                Forms\Components\TextInput::make('admission_number')
                    ->required()
                    ->maxLength(255)
                    ->unique('students', 'admission_number', ignoreRecord: true),
                Forms\Components\Select::make('class_id')
                    ->relationship('st_class', 'class_name')
                    ->searchable()
                    ->nullable(),
                Forms\Components\TextInput::make('section')
                    ->maxLength(50),
                Forms\Components\TextInput::make('emergency_contact_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('emergency_contact_phone')
                    ->required()
                    ->maxLength(15),
                Forms\Components\FileUpload::make('profile_photo')
                    ->image()
                    ->directory('students/profile_photos'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('first_name')
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('st_class.class_name')
                    ->label('Class')
                    ->sortable(),
                Tables\Columns\TextColumn::make('admission_number')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent_phone_1')
                    ->label('Parent Phone')
                    ->searchable(),
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
