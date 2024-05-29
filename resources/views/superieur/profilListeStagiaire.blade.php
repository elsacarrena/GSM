@extends('layouts.superieur')

@section('content')
    <div class="container">

        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">Liste d'informations d'un stagiaire </div>

                <div class="card-body">
                    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

                    <a href="{{ route('stagiaires.profilForm') }}" class="btn btn-primary">Ajouter une information dun stagiaire</a>

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
                                <th>Date_naissance</th>
                                <th>Numéro</th>
                                <th>Domaine</th>
                                <th>Groupe sanguin</th>
                                <th>Maladie</th>
                                <th>Localisation</th>
                                <th>Nom_Pere</th>
                                <th>Nom_Mere</th>
                                <th>Numero_Pere</th>
                                <th>Numero_Mere</th>
                                <th>Numéro_urgence</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($profils as $profil)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $profil->nom }}</td>
                                    <td>{{ $profil->date_naissance}}</td>
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
                                        <div class="btn-group"><a href="{{ route('stagiaires.profilEdit', ['id'=> $profil->id]) }}" class="btn btn-primary btn-sm">Modifier</a>

                                            <form action="{{ route('stagiaires.profilDestroy', ['id'=> $profil->id]) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>

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
            return confirm("Êtes-vous sûr de vouloir supprimer ce stagiaire ?");
        }
    </script>

@endsection
