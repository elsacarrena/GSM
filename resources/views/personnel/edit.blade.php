@extends('layouts.app')

@section('content')
    <div class="container">

        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
        <form action="{{ route('personnel.update', $personnel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Vos champs de formulaire pour les informations de létudiant à modifier -->
            <div class="form-group">
                <label for="nom">Votre nom </label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{$personnel->nom }}" required>
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
                <label for="localisation"> Votre  Localisation </label>
                <input type="text" name="localisation" id="localisation" class="form-control" value="{{$personnel->localisation}}" required>
            </div>

            <div class="form-group">
                <label for="numero_urgence"> Numéro à contacter en cas durgence </label>
                <input type="text" name="numero_urgence" id="numero_urgence" class="form-control" value="{{$personnel->numero_urgence}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
