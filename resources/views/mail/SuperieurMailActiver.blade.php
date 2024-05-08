<x-mail::message>
    <p>Bonjour <strong>{{$userName}}</strong></p>
    <p> Votre compte a été bien créé.</p>
    <p>Veuillez cliquer ci-dessous pour activer votre compte.</p>

<x-mail::button :url="route('activation.compte', ['id' => $id])">
    Activer mon compte
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

