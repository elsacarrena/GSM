@extends('layouts.employe')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste dinformations dun employe </div>

            <div class="card-body">
                <link href="{{ asset('css/index.css') }}" rel="stylesheet">
                <a href="{{ route('employe.profilform') }}" class="btn btn-primary">Ajouter une information dun employe</a>

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
                            <th>Type</th>
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
                                <td>{{ $profil->type }}</td>
                                <td>{{ $profil->groupe_sanguin }}</td>
                                <td>{{ $profil->maladie }}</td>
                                <td>{{ $profil->localisation }}</td>
                                <td>{{ $profil->nom_pere }}</td>
                                <td>{{ $profil->nom_mere }}</td>
                                <td>{{ $profil->numero_pere }}</td>
                                <td>{{ $profil->numero_mere }}</td>
                                <td>{{ $profil->numero_urgence }}</td>
                                <td>
                                    <div class="btn-group"><a href="{{ route('employe.profilEdit', $profil) }}" class="btn btn-primary btn-sm">Modifier</a>

                                   <form action="{{ route('employe.profilDestroy', $profil) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>

                                   </form>
                                </div>
                                    {{--  <a href="{{ route('stagiaires.profilEdit', $profil) }}" class="btn btn-primary btn-sm">Modifier</a>
                                    <br>
                                     <br>
                                    <form action="{{ route('stagiaires.profilDestroy', $profil) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>

                                    </form>  --}}
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
        return confirm("Êtes-vous sûr de vouloir supprimer ce profil ?");
    }
</script>

@endsection
