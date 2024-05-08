@extends('layouts.chefservice')

@section('content')
<div class="container">
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Ajouter un nouveau profil de chef de service</div>

            <div class="card-body">
                <hr>
                <h1>Les champs avec <span class="required">*</span> sont obligatoires :</h1>

                <form action="{{ route('chef_service.profilStore') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="numero">Numéro: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                    <div class="form-group">
                        <label for="domaine">Domaine: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="domaine" name="domaine" required>
                    </div>

                    <div class="form-group">
                        <label for="groupe_sanguin">Groupe sanguin: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="groupe_sanguin" name="groupe_sanguin" required>
                    </div>
                    <div class="form-group">
                        <label for="maladie">Maladie: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="maladie" name="maladie" required>
                    </div>
                    <div class="form-group">
                        <label for="localisation">Localisation: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="localisation" name="localisation" required>
                    </div>
                    <div class="form-group">
                        <label for="nom_pere">Nom père: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="nom_pere" name="nom_pere" required>
                    </div>
                    <div class="form-group">
                        <label for="nom_mere">Nom mère: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="nom_mere" name="nom_mere" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_pere">Numéro père: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="numero_pere" name="numero_pere" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_mere">Numéro mère: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="numero_mere" name="numero_mere" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_urgence">Numéro urgence: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="numero_urgence" name="numero_urgence" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Ajouter un profil chef de service</button>
                    <a href="{{ route('chef_service.profilListe') }}" class=" btn btn-danger"> Revenir a la liste des infos d'un chef de service</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
