@extends('layouts.app')

@section('content')
    <div class="container">

        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
        <form action="{{ route('departements.update', $personnel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Vos champs de formulaire pour les informations de l'étudiant à modifier -->
            <div class="form-group">
                <label for="nom">Nom du département </label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ $departements->nom }}" required>
            </div>


            <div class="form-group">
                <label for="numero"> Description du département </label>
                <input type="text" name="description" id="description" class="form-control"  value="{{ $departements->description}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
