
@extends('layouts.app')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">Ajouter un département</div>
            <div class="card-body">
                <hr>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('departements.store') }}" method="POST">
                    @csrf
                    <h1>Veuillez remplir ces champs<h1>
                    <div class="form-group">
                        <label for="nom">Nom du département <span> *</span> </label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                        @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description"> Description du département  <span> *</span></label>
                        <input type="text" name="description" id="description" class="form-control" required>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                    <button type="submit" class="btn btn-primary">Ajouter un département</button> <br><br>
                    <a href="{{ route('departements.index') }}" class="btn btn-danger">Revenir à la liste des departements</a>


                </form>
            </div>
        </div>
    </div>
@endsection
