<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AcademicProgressRelationManager extends RelationManager
{
    protected static string $relationship = 'academicProgress';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'subject_name')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('progress_type')
                    ->options([
                        'Exam' => 'Exam',
                        'Project' => 'Project',
                        'Assignment' => 'Assignment',
                        'Class Participation' => 'Class Participation',
                        'Other' => 'Other',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->nullable(),
                Forms\Components\TextInput::make('grade')
                    ->maxLength(10)
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Completed' => 'Completed',
                        'Pending' => 'Pending',
                        'In-Progress' => 'In-Progress',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('term')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('academic_year')
                    ->required()
                    ->maxLength(20),
                Forms\Components\DatePicker::make('date_recorded')
                    ->required(),
                Forms\Components\Textarea::make('teacher_comments')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('progress_type')
            ->columns([
                Tables\Columns\TextColumn::make('student.first_name')
                    ->label('Student'),
                Tables\Columns\TextColumn::make('subject.title')
                    ->label('Subject'),
                Tables\Columns\TextColumn::make('progress_type'),
                Tables\Columns\TextColumn::make('grade'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('term'),
                Tables\Columns\TextColumn::make('academic_year'),
                Tables\Columns\TextColumn::make('date_recorded')
                    ->date(),
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
