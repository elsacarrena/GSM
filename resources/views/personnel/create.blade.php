@extends('layouts.app')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">Ajouter un membre</div>
            <div class="card-body">
                <hr>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('personnel.store') }}" method="POST">
                    @csrf
                    <h1>Veuillez remplir ces champs</h1>
                    <div class="form-group">
                        <label for="nom">Nom <span>*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control form-control-sm" required>
                        @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="numero">Numéro <span>*</span></label>
                        <input type="text" name="numero" id="numero" class="form-control form-control-sm" required>
                        @error('numero')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="domaine">Domaine de travail <span>*</span></label>
                        <input type="text" name="domaine" id="domaine" class="form-control form-control-sm" required>
                        @error('domaine')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="groupe_sanguin">Groupe sanguin <span>*</span></label>
                        <input type="text" name="groupe_sanguin" id="groupe_sanguin" class="form-control form-control-sm" required>
                        @error('groupe_sanguin')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="maladie">Maladies spécifiques <span>*</span></label>
                        <input type="text" name="maladie" id="maladie" class="form-control form-control-sm" required>
                        @error('maladie')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="localisation">Localisation</label>
                        <input type="text" name="localisation" id="localisation" class="form-control form-control-sm" required>
                        @error('localisation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nom_pere">Nom du père <span>*</span></label>
                        <input type="text" name="nom_pere" id="nom_pere" class="form-control form-control-sm" required>
                        @error('nom_pere')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nom_mere">Nom de la mère <span>*</span></label>
                        <input type="text" name="nom_mere" id="nom_mere" class="form-control form-control-sm" required>
                        @error('nom_mere')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="numero_pere">Numéro du père <span>*</span></label>
                        <input type="text" name="numero_pere" id="numero_pere" class="form-control form-control-sm" required>
                        @error('numero_pere')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="numero_mere">Numéro de la mère <span>*</span></label>
                        <input type="text" name="numero_mere" id="numero_mere" class="form-control form-control-sm" required>
                        @error('numero_mere')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="numero_urgence">Numéro d'urgence <span>*</span></label>
                        <input type="text" name="numero_urgence" id="numero_urgence" class="form-control form-control-sm" required>
                        @error('numero_urgence')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Ajouter un membre</button>
                    <br><br>
                    <a href="{{ route('personnel.index') }}" class="btn btn-danger btn-sm">Revenir à la liste des membres</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
