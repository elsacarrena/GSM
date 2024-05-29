@extends('layouts.employe')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <form action="{{ route('employe.profilUpdate', $profil->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $profil->nom }}" required>
        </div>

        <div class="form-group">
            <label for="date_naissance">Date de naissance: <span class="required">*</span></label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
        </div>
        <div class="form-group">
            <label for="numero">Numéro</label>
            <input type="text" name="numero" id="numero" class="form-control" value="{{ $profil->numero }}" required>
        </div>

        <div class="form-group">
            <label for="domaine">Domaine</label>
            <input type="text" name="domaine" id="domaine" class="form-control" value="{{ $profil->domaine }}" required>
        </div>



        <div class="form-group">
            <label for="groupe_sanguin">Groupe sanguin</label>
            <input type="text" name="groupe_sanguin" id="groupe_sanguin" class="form-control" value="{{ $profil->groupe_sanguin }}" required>
        </div>

        <div class="form-group">
            <label for="maladie">Maladie</label>
            <input type="text" name="maladie" id="maladie" class="form-control" value="{{ $profil->maladie }}" required>
        </div>

        <div class="form-group">
            <label for="localisation">Localisation</label>
            <input type="text" name="localisation" id="localisation" class="form-control" value="{{ $profil->localisation }}" required>
        </div>

        <div class="form-group">
            <label for="situation_matrimoniale">Situation matrimoniale: </label>
            <input type="text" class="form-control" id="situation_matrimoniale" name="situation_matrimoniale">
        </div>
        <div class="form-group">
            <label for="nom_pere">Nom du père</label>
            <input type="text" name="nom_pere" id="nom_pere" class="form-control" value="{{ $profil->nom_pere }}" required>
        </div>

        <div class="form-group">
            <label for="nom_mere">Nom de la mère</label>
            <input type="text" name="nom_mere" id="nom_mere" class="form-control" value="{{ $profil->nom_mere }}" required>
        </div>

        <div class="form-group">
            <label for="numero_pere">Numéro du père</label>
            <input type="text" name="numero_pere" id="numero_pere" class="form-control" value="{{ $profil->numero_pere }}" required>
        </div>

        <div class="form-group">
            <label for="numero_mere">Numéro de la mère</label>
            <input type="text" name="numero_mere" id="numero_mere" class="form-control" value="{{ $profil->numero_mere }}" required>
        </div>

        <div class="form-group">
            <label for="numero_urgence">Numéro urgence</label>
            <input type="text" name="numero_urgence" id="numero_urgence" class="form-control" value="{{ $profil->numero_urgence }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier un employé</button>
    </form>
</div>
@endsection
