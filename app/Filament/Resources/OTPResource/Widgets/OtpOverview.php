<?php

namespace App\Filament\Resources\OTPResource\Widgets;

use App\Models\OTP;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OtpOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total OTPs Sent', OTP::count())
                ->description('Total number of OTPs sent')
                ->descriptionIcon('heroicon-m-paper-airplane'),

            Stat::make('Verified OTPs', OTP::where('is_verified', true)->count())
                ->description('Total number of verified OTPs')
                ->descriptionIcon('heroicon-m-check-circle'),

            Stat::make('Expired OTPs', OTP::where('expires_at', '<', now())->count())
                ->description('Total number of expired OTPs')
                ->descriptionIcon('heroicon-m-x-circle'),

            Stat::make('Active OTPs', OTP::where('expires_at', '>', now())->where('is_verified', false)->count())
                ->description('Total number of active OTPs')
                ->descriptionIcon('heroicon-m-lock-closed'),
        ];
    }
}
