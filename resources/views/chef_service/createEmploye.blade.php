@extends('layouts.chefservice')

@section('content')
<div class="container">
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Ajouter un nouveau collaborateur</div>

            <div class="card-body">
                <hr>
                <h1>Les champs avec <span class="required">*</span> sont obligatoires :</h1>

                <form action="{{route('employe.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for=" numero">Numéro: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                    <div class="form-group">
                        <label for=" domaine">Domaine: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="domaine" name="domaine" required>
                    </div>
                    <div class="form-group">
                        <label for="localisation">Localisation: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="localisation" name="localisation" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_urgence">Numero en cas durgence: <span class="required">*</span></label>
                        <input type="text" class="form-control" id="numero_urgence" name="numero_urgence" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Ajouter un employé</button>
                    <a href="{{ route('employe.index') }}" class=" btn btn-danger">Revenir a la liste des employés</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
