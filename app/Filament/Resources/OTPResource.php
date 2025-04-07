<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OTPResource\Pages;
use App\Filament\Resources\OTPResource\RelationManagers;
use App\Filament\Resources\OTPResource\Widgets\OtpOverview;
use App\Filament\Resources\OTPResource\RelationManagers\StudentRelationManager;
use App\Filament\Resources\OTPResource\RelationManagers\StClassRelationManager;
use App\Models\OTP;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OTPResource extends Resource
{
    protected static ?string $model = OTP::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-open';

    protected static ?string $modelLabel = 'One Time Password for Access';

    protected static ?string $navigationLabel = 'One Time Password';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('otp_code')
                    ->required(),
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'id')
                    ->required(),
                Forms\Components\TextInput::make('class_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('expires_at')
                    ->required(),
                Forms\Components\Toggle::make('is_verified')
                    ->required(),
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
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('otp_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.first_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stClass.class_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->boolean(),
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
            StudentRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOTPS::route('/'),
            'create' => Pages\CreateOTP::route('/create'),
            'view' => Pages\ViewOTP::route('/{record}'),
            'edit' => Pages\EditOTP::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            OtpOverview::class,
        ];
    }
}
