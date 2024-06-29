<x-mail::message>
## {{ __('Verify Your Email') }}

**Welcome to the Iranian Pilots Association!**

To complete your registration, please verify your email address by entering the code below:

##  {{ $code }}

**This link will expire in {{ config('auth.verification.expire', 60) }} minutes.**

**If you did not request this verification, please ignore this email.**

**Thank you,**
<br>
The Iranian Pilots Association Team
</x-mail::message>
