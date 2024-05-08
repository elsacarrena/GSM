@extends('layouts.chefservice')

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
                    <h3>Bienvenue sur la page des Chefs Services</h3>
                    {{ __('Vous etes connecté!') }}
                    <a href="{{ route('chef_service.create') }}" class="btn btn-primary">Ajouter un chef service </a>
                    <a href="{{ route('chef_service.index') }} " class="btn btn-danger">Revenir a la liste des chef services</a>
                    <br><br>
                    <a href="{{ route('chef_service.profilForm') }}" class="btn btn-primary">Ajouter une information dun chefservice</a>
                    <a href=" {{ route('chef_service.profilListe') }}" class="btn btn-primary">Liste_information dun chefservice</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
