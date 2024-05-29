{{--  <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>  --}}

{{--  <x-mail::message>
<p>Bonjour <strong>{{$userName}}</strong></p>
   <p> Votre compte a été bien créé.</p>
   <p>Veuillez cliquer ci-dessous pour creer votre compte.Le code est 1111</p>


   <x-mail::button :url="route('activation.compte', ['id' => $id])">
     Creer mon compte
</x-mail::button>


Merci pour votre confiance nous sommes impatients de vous revoir ,<br>
{{ config('app.name') }}
</x-mail::message>  --}}

<x-mail::message>
    <p>Bonjour <strong>{{ $userName }}</strong>,</p>
    <p>Veuillez cliquer sur le lien ci-dessous pour accéder au formulaire de création de compte :</p>
    <p>Votre code_inscription est : <strong>{{ $code }}</strong></p>
    <x-mail::button :url="route('inscription_employe')">
        Créer mon compte
    </x-mail::button>
    <p>Merci pour votre confiance, nous sommes impatients de vous revoir,</p>
    {{ config('app.name') }}
</x-mail::message>

