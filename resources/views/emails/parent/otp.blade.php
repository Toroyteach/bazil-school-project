@component('mail::message')
# Hello Parent Gurdian,

You’ve requested to access student info for **{{ $studentName }}** via **{{ config('app.name') }}**.

**Your OTP is:**
# {{ $otp }}
_Valid for 30 minutes._

@component('mail::button', ['url' => config('app.url') . '/student-access'])
Access Student Info
@endcomponent

Thanks,
**{{ config('app.name') }} Team**
@endcomponent