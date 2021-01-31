@component('mail::newUser')

@slot('name')
{{$user->getFullNameAttribute()}}
@endslot

@slot('url')
{{ route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}
@endslot

@endcomponent
