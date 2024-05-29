{{--  <x-mail::message>
    <p>Bonjour <strong>{{$userName}}</strong></p>
    <p> Votre compte a été bien créé.</p>
    <p>Veuillez cliquer ci-dessous pour activer votre compte.</p>

<x-mail::button :url="route('activation.compte', ['id' => $id])">
    Activer mon compte
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>  --}}

<xmail::message>
    <p>Bonjour <strong>{{$userName}}</strong></p>
    <p> Votre compte a été bien créé.</p>
    <p>Veuillez cliquer ci-dessous pour activer votre compte.</p>

    <a href="{{ route('activation.compte', ['id' => $id]) }} " class=" btn btn-success" style="
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #ffffff;
    background-color: #007bff;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    margin: 10px 0; ">Activer mon compte</a>



    Merci,<br>
    {{ config('app.name') }}
</xmail::message>
