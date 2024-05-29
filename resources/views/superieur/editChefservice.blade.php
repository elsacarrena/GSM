@extends('layouts.chefservice')

@section('content')
    <div class="container">

        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
        <form action="{{ route('chef_service.update', $chefservice->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Vos champs de formulaire pour les informations de létudiant à modifier -->
            <div class="form-group">
                <label for="nom">Votre nom </label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{$chefservice->nom }}" required>
            </div>


            <div class="form-group">
                <label for="numero"> Votre numéro </label>
                <input type="text" name="numero" id="numero" class="form-control"  value="{{ $chefservice->numero}}" required>
            </div>

            <div class="form-group">
                <label for="domaine"> Votre domaine de travail </label>
                <input type="text" name="domaine" id="domaine" class="form-control"  value="{{$chefservice->domaine}}" required>
            </div>

            <div class="form-group">
                <label for="date_debut"> Date de prise de service </label>
                <input type="date-time" name="date_debut" id="date_debut" class="form-control"  value="{{ $chefservice->date_debut}}" required>
            </div>
            <div class="form-group">
                <label for="date_fin"> Date de fin de service </label>
                <input type="date-time" name="date_fin" id="date_fin" class="form-control"  value="{{ $chefservice->date_fin}}" required>
            </div>
            <div class="form-group">
                <label for="numero"> Date additionnelle </label>
                <input type="date-time" name="date_additionnelle" id="date_additionnelle" class="form-control"  value="{{ $chefservice->date_additionnelle}}" required>
            </div>

            <div class="form-group">
                <label for="localisation"> Votre  Localisation </label>
                <input type="text" name="localisation" id="localisation" class="form-control" value="{{$chefservice->localisation}}" required>
            </div>

            <div class="form-group">
                <label for="numero_urgence"> Numéro à contacter en cas durgence </label>
                <input type="text" name="numero_urgence" id="numero_urgence" class="form-control" value="{{$chefservice->numero_urgence}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier un chef de service</button>
        </form>
    </div>
@endsection
