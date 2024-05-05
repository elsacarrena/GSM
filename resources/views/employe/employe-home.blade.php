@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tableau de bord') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Bienvenue sur la page des Employés</h3>
                    {{ __('Vous etes connecté!') }}
                    <a href="{{ route('employe.create') }}" class="btn btn-primary">Ajouter un employe</a>
                    <a href="{{ route('employe.index') }} " class="btn btn-danger">Revenir a la liste des employe</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
