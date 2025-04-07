<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolFeeResource\Pages;
use App\Filament\Resources\SchoolFeeResource\RelationManagers;
use App\Filament\Resources\SchoolFeeResource\RelationManagers\PaymentMethodRelationManager;
use App\Filament\Resources\SchoolFeeResource\RelationManagers\StClassRelationManager;
use App\Filament\Resources\SchoolFeeResource\RelationManagers\StudentsRelationManager;
use App\Filament\Resources\SchoolFeeResource\Widgets\SchoolFeesOverview;
use App\Models\SchoolFee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolFeeResource extends Resource
{
    protected static ?string $model = SchoolFee::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $modelLabel = 'Students School Fees';

    protected static ?string $navigationLabel = 'School Fees';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'id')
                    ->required(),
                Forms\Components\TextInput::make('class_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_due')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_paid')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('balance')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\DatePicker::make('due_date')
                    ->required(),
                Forms\Components\Select::make('payment_method_id')
                    ->relationship('paymentMethod', 'id'),
                Forms\Components\Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                \Filament\Tables\Actions\Action::make('info')
                    ->label('School Fees')
                    ->disabled()
                    ->color('gray')
                    ->icon('heroicon-o-information-circle')
                    ->extraAttributes(['class' => 'text-lg text-gray-500 font-semibold'])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('student.first_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_due')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
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
            StudentsRelationManager::class,
            StClassRelationManager::class,
            PaymentMethodRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolFees::route('/'),
            'create' => Pages\CreateSchoolFee::route('/create'),
            'view' => Pages\ViewSchoolFee::route('/{record}'),
            'edit' => Pages\EditSchoolFee::route('/{record}/edit'),
        ];
    }
    
    public static function getWidgets(): array
    {
        return [
            SchoolFeesOverview::class,
        ];
    }
}
