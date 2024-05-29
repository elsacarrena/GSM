@extends('layouts.chefservice')

@section('content')
    <div class="container">

        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
        <form action="{{ route('chef_service.update_appreciation', $chefservice->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Votre nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ $chefservice->nom }}" required>
            </div>

            <div class="form-group">
                <label for="domaine">Votre domaine de travail</label>
                <input type="text" name="domaine" id="domaine" class="form-control" value="{{ $chefservice->domaine }}" required>
            </div>

            <div class="form-group">
                <label for="ponctualite">Ponctualité</label>
                <input type="text" name="ponctualite" id="ponctualite" class="form-control" value="{{ $chefservice->ponctualite }}" required>
            </div>

            <div class="form-group">
                <label for="assiduite">Assiduité</label>
                <input type="text" name="assiduite" id="assiduite" class="form-control" value="{{ $chefservice->assiduite }}" required>
            </div>

            <div class="form-group">
                <label for="creativite">Créativité</label>
                <input type="text" name="creativite" id="creativite" class="form-control" value="{{ $chefservice->creativite }}" required>
            </div>

            <div class="form-group">
                <label for="engagement">Engagement</label>
                <input type="text" name="engagement" id="engagement" class="form-control" value="{{ $chefservice->engagement }}" required>
            </div>

            <div class="form-group">
                <label for="motivation">Motivation</label>
                <input type="text" name="motivation" id="motivation" class="form-control" value="{{ $chefservice->motivation }}" required>
            </div>

            <div class="form-group">
                <label for="initiative">Initiative</label>
                <input type="text" name="initiative" id="initiative" class="form-control" value="{{ $chefservice->initiative }}" required>
            </div>

            <div class="form-group">
                <label for="sociabilite">Sociabilité</label>
                <input type="text" name="sociabilite" id="sociabilite" class="form-control" value="{{ $chefservice->sociabilite }}" required>
            </div>

            <div class="form-group">
                <label for="gout_risque">Goût du risque</label>
                <input type="text" name="gout_risque" id="gout_risque" class="form-control" value="{{ $chefservice->gout_risque }}" required>
            </div>

            <div class="form-group">
                <label for="autres_appreciations">Autres appréciations</label>
                <input type="text" name="autres_appreciations" id="autres_appreciations" class="form-control" value="{{ $chefservice->autres_appreciations }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier une appréciation</button>
        </form>
    </div>
@endsection
