@extends('layouts.superieur')

@section('content')
<div class="container">
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Renseignez vos appréciations</div>

            <div class="card-body">
                <hr>
                <h1>Les champs avec <span class="required">*</span> sont obligatoires :</h1>

                <form action="{{route('superieur.storeAppreciation') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>

                    <div class="form-group">
                        <label for=" domaine">Domaine: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="domaine" name="domaine" required>
                    </div>
                    <div class="form-group">
                        <label for="ponctualite">Ponctualité: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="ponctualite" name="ponctualite" required>
                    </div>

                    <div class="form-group">
                        <label for="assiduite">Assiduité: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="assiduite" name="assiduite" required>
                    </div>
                    <div class="form-group">
                        <label for="creativite">Créativité: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="creativite" name="creativite" required>
                    </div>
                    <div class="form-group">
                        <label for="engagement">Engagement: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="engagement" name="engagement" required>
                    </div>
                    <div class="form-group">
                        <label for="motivation">Motivation: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="motivation" name="motivation" required>
                    </div>
                    <div class="form-group">
                        <label for="initiative">Initiative: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="initiative" name="initiative" required>
                    </div>
                    <div class="form-group">
                        <label for="sociabilite">Sociabilité: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="sociabilite" name="sociabilite" required>
                    </div>
                    <div class="form-group">
                        <label for="gout_risque">Gout du risque: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="gout_risque" name="gout_risque" required>
                    </div>
                    <div class="form-group">
                        <label for="autres_appreciations">Autres appréciations: <span class="required">*</span></label>
                        <input type="int" class="form-control" id="autres_appreciations" name="autres_appreciations" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Renseignez vos appréciations</button>
                    <a href="{{ route('superieur.index_appreciation') }}" class="btn btn-danger">Revenir a la liste des appréciations</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
