<?php

namespace App\Filament\Resources\OTPResource\Pages;

use App\Filament\Resources\OTPResource;
use App\Filament\Resources\OTPResource\Widgets\OtpOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOTPS extends ListRecords
{
    protected static string $resource = OTPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OtpOverview::class,
        ];
    }
}
