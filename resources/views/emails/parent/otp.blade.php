<x-mail::message>
    # Hello {{ $parentName }},

    You’ve requested to access student info for **{{ $studentName }}** via **{{ config('app.name') }}**.

    <x-mail::panel>
        **Your OTP is:**
        # {{ $otp }}
        _Valid for 30 minutes._
    </x-mail::panel>

    <x-mail::button :url="config('app.url')">
        Access Student Info
    </x-mail::button>

    Thanks,
    **{{ config('app.name') }} Team**
</x-mail::message>