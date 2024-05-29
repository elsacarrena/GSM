@extends('layouts.employe')

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
                    <a href="{{ route('employe.create') }}" class="btn btn-danger"> Ajouter un employé </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
