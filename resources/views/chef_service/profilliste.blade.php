@extends('layouts.chefservice')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste d'informations d'un chef de service </div>

            <div class="card-body">
                <link href="{{ asset('css/index.css') }}" rel="stylesheet">
                <a href="{{ route('chef_service.profilform') }}" class="btn btn-primary">Ajouter une information d'un chef de service</a>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Numéro</th>
                            <th>Domaine</th>
                            <th>Groupe sanguin</th>
                            <th>Maladie</th>
                            <th>Localisation</th>
                            <th>Nom Pere</th>
                            <th>Nom Mere</th>
                            <th>Numero Pere</th>
                            <th>Numero Mere</th>
                            <th>Numéro urgence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profils as $profil)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $profil->nom }}</td>
                                <td>{{ $profil->numero }}</td>
                                <td>{{ $profil->domaine }}</td>
                                <td>{{ $profil->groupe_sanguin }}</td>
                                <td>{{ $profil->maladie }}</td>
                                <td>{{ $profil->localisation }}</td>
                                <td>{{ $profil->nom_pere }}</td>
                                <td>{{ $profil->nom_mere }}</td>
                                <td>{{ $profil->numero_pere }}</td>
                                <td>{{ $profil->numero_mere }}</td>
                                <td>{{ $profil->numero_urgence }}</td>
                                <td>
                                    <div class="btn-group"><a href="{{ route('chef_service.profiledit', $profil) }}" class="btn btn-primary btn-sm">Modifier un chef de service</a>

                                   <form action="{{ route('chef_service.profilDestroy', $profil) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-sm btn-danger">Supprimer un chef de service</button>

                                   </form>
                                </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer cet chef de service ?");
    }
</script>

@endsection
