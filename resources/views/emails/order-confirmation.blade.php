<x-mail::message>
# Dear {{ auth()->user()->name }},

{!! nl2br($data['message']) !!}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
