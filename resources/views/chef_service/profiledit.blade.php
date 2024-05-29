@extends('layouts.chefservice')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header"> Modifier un profil de chef de service</div>

            <div class="card-body">
                <hr>
                <h1>Les champs avec <span class="required">*</span> sont obligatoires :</h1>
    <form action="{{ route('chef_service.profilUpdate', $profil->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom<span class="required">*</span></label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $profil->nom }}" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">date_naissance<span class="required">*</span></label>
            <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="{{ $profil-> date_naissance }}" required>
        </div>
        <div class="form-group">
            <label for="numero">Numéro<span class="required">*</span></label>
            <input type="text" name="numero" id="numero" class="form-control" value="{{ $profil->numero }}" required>
        </div>

        <div class="form-group">
            <label for="domaine">Domaine<span class="required">*</span></label>
            <input type="text" name="domaine" id="domaine" class="form-control" value="{{ $profil->domaine }}" required>
        </div>



        <div class="form-group">
            <label for="groupe_sanguin">Groupe sanguin<span class="required">*</span></label>
            <input type="text" name="groupe_sanguin" id="groupe_sanguin" class="form-control" value="{{ $profil->groupe_sanguin }}" required>
        </div>

        <div class="form-group">
            <label for="maladie">Maladie<span class="required">*</span></label>
            <input type="text" name="maladie" id="maladie" class="form-control" value="{{ $profil->maladie }}" required>
        </div>

        <div class="form-group">
            <label for="localisation">Localisation<span class="required">*</span></label>
            <input type="text" name="localisation" id="localisation" class="form-control" value="{{ $profil->localisation }}" required>
        </div>

        <div class="form-group">
            <label for="nom_pere">Nom du père<span class="required">*</span></label>
            <input type="text" name="nom_pere" id="nom_pere" class="form-control" value="{{ $profil->nom_pere }}" required>
        </div>

        <div class="form-group">
            <label for="nom_mere">Nom de la mère<span class="required">*</span></label>
            <input type="text" name="nom_mere" id="nom_mere" class="form-control" value="{{ $profil->nom_mere }}" required>
        </div>

        <div class="form-group">
            <label for="numero_pere">Numéro du père<span class="required">*</span></label>
            <input type="text" name="numero_pere" id="numero_pere" class="form-control" value="{{ $profil->numero_pere }}" required>
        </div>

        <div class="form-group">
            <label for="numero_mere">Numéro de la mère<span class="required">*</span></label>
            <input type="text" name="numero_mere" id="numero_mere" class="form-control" value="{{ $profil->numero_mere }}" required>
        </div>

        <div class="form-group">
            <label for="numero_urgence">Numéro urgence<span class="required">*</span></label>
            <input type="text" name="numero_urgence" id="numero_urgence" class="form-control" value="{{ $profil->numero_urgence }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier un chef de service</button>
    </form>
</div>
@endsection
