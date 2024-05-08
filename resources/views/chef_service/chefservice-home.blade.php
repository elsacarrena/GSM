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
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
