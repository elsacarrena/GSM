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
                    {{ __('Vous etes connecté!') }}
                    {{--  <a href="{{ route('employe.create') }}" class="btn btn-primary">Ajouter un employe</a>
                    <a href="{{ route('employe.index') }} " class="btn btn-danger">Revenir a la liste des employe</a>
                    <a href="{{ route('stagiaires.create') }}" class="btn btn-primary">Ajouter un stagiaire</a>
                    <a href="{{ route('stagiaires.index') }} " class="btn btn-danger">Revenir a la liste des stagiaires</a>  --}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
