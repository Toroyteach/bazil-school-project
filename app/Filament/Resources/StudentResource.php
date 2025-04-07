<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Filament\Resources\StudentResource\RelationManagers\AcademicProgressRelationManager;
use App\Filament\Resources\StudentResource\RelationManagers\OtpRelationManager;
use App\Filament\Resources\StudentResource\RelationManagers\SchoolFeesRelationManager;
use App\Filament\Resources\StudentResource\RelationManagers\StClassesRelationManager;
use App\Filament\Resources\StudentResource\Widgets\StudentsOverview;
use App\Models\StClass;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $modelLabel = 'Students';

    protected static ?string $navigationLabel = 'Students';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('middle_name'),
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\TextInput::make('gender')
                    ->required(),
                Forms\Components\DatePicker::make('dob')
                    ->required(),
                Forms\Components\TextInput::make('address'),
                Forms\Components\TextInput::make('city')
                    ->required(),
                Forms\Components\TextInput::make('state')
                    ->required(),
                Forms\Components\TextInput::make('country')
                    ->required(),
                Forms\Components\TextInput::make('postal_code'),
                Forms\Components\TextInput::make('parent_phone_1')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('parent_phone_2')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('parent_email_1')
                    ->email(),
                Forms\Components\TextInput::make('parent_email_2')
                    ->email(),
                Forms\Components\DatePicker::make('admission_date')
                    ->required(),
                Forms\Components\TextInput::make('admission_number')
                    ->required(),
                Forms\Components\Select::make('class_id')
                    ->label('Class')
                    ->options(StClass::pluck('class_name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('section'),
                Forms\Components\TextInput::make('emergency_contact_name')
                    ->required(),
                Forms\Components\TextInput::make('emergency_contact_phone')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('profile_photo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                \Filament\Tables\Actions\Action::make('info')
                    ->label('Students')
                    ->disabled()
                    ->color('gray')
                    ->icon('heroicon-o-information-circle')
                    ->extraAttributes(['class' => 'text-lg text-gray-500 font-semibold'])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('admission_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('admission_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('st_class.class_name')
                    ->numeric()
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
            StClassesRelationManager::class,
            SchoolFeesRelationManager::class,
            OtpRelationManager::class,
            AcademicProgressRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StudentsOverview::class,
        ];
    }
}
