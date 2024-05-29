@extends('layouts.superieur')

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
                    <h3>Bienvenue sur la page  des supérieurs</h3>
                    Vous etes connecté!
                    <a href="{{ route('employe.creation') }}" class="btn btn-danger"> Ajouter un nouvel employé </a>
                    <a href="{{ route('stagiaires.creation') }}" class="btn btn-primary"> Ajouter un nouvel stagiaire </a>
                    <a href="{{ route('chef_service.creation') }}" class="btn btn-danger"> Ajouter un nouveau chefservice </a>
                    {{--  <a href="{{ route('superieur.IndexEmploye') }}" class="btn btn-danger">Liste info employes moins personnelle </a>    --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
