@extends('layouts.app')

@section('content')
    <div class="container">

        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
        <form action="{{ route('personnel.update', $personnel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Vos champs de formulaire pour les informations de l'étudiant à modifier -->
            <div class="form-group">
                <label for="nom">Votre nom </label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ $personnel->nom }}" required>
            </div>


            <div class="form-group">
                <label for="numero"> Votre numéro </label>
                <input type="text" name="numero" id="numero" class="form-control"  value="{{ $personnel->numero}}" required>
            </div>

            <div class="form-group">
                <label for="domaine"> Votre domaine de travail </label>
                <input type="text" name="domaine" id="domaine" class="form-control"  value="{{$personnel->domaine}}" required>
            </div>

            <div class="form-group">
                <label for="groupe_sanguin"> Votre groupe sanguin </label>
                <input type="text" name="groupe_sanguin" id="groupe_sanguin" class="form-control" value="{{$personnel->groupe_sanguin}}" required>
            </div>
            <div class="form-group">
                <label for="maladie"> Maladie spécifique </label>
                <input type="text" name="maladie" id="maladie " class="form-control" value="{{$personnel->maladie}}" required>
            </div>

            <div class="form-group">
                <label for="localisation"> Votre  Localisation </label>
                <input type="text" name="localisation" id="localisation" class="form-control" value="{{$personnel->localisation}}" required>
            </div>

            <div class="form-group">
                <label for="nom_pere"> Nom du père </label>
                <input type="text" name="nom_pere" id="nom_pere" class="form-control" value="{{$personnel->nom_pere}}" required>
            </div>

            <div class="form-group">
                <label for="numero">Nom de la mère </label>
                <input type="text" name="nom_mere" id="nom_mere" class="form-control" value="{{$personnel->nom_mere}}" required>
            </div>

            <div class="form-group">
                <label for="numero"> Numéro de votre père </label>
                <input type="text" name="numero_pere" id="numero_pere" class="form-control" value="{{$personnel->numero_pere}}" required>
            </div>

            <div class="form-group">
                <label for="numero"> Numéro de votre mère </label>
                <input type="text" name="numero_mere" id="numero_mere" class="form-control" value="{{$personnel->numero_mere}}" required>
            </div>

            <div class="form-group">
                <label for="numero_urgence"> Numéro à contacter en cas d'urgence </label>
                <input type="text" name="numero_urgence" id="numero_urgence" class="form-control" value="{{$personnel->numero_urgence}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
