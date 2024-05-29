@extends('layouts.superieur')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste des appréciations</div>

            <div class="card-body">
                <link href="{{ asset('css/index.css') }}" rel="stylesheet">
                <a href="{{ route('superieur.appreciation') }}" class="btn btn-primary">Renseignez vos appréciations</a>

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
                            <th>domaine</th>
                            <th>Ponctualité</th>
                            <th>Assiduité</th>
                            <th>Créativité</th>
                            <th>Engagement</th>
                            <th>Motivation</th>
                            <th>Initiative</th>
                            <th>Sociabilité</th>
                            <th>Gout du risque</th>
                            <th>Autres appréciations</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($superieurs as $superieur)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $superieur->nom}}</td>
                                <td>{{ $superieur->domaine}}</td>
                                <td>{{ $superieur->ponctualite}}</td>
                                <td>{{ $superieur->assiduite}}</td>
                                <td>{{ $superieur->creativite}}</td>
                                 <td>{{ $superieur->engagement}}</td>
                                 <td>{{ $superieur->motivation }}</td>
                                 <td>{{ $superieur->initiative }}</td>
                                <td>{{ $superieur->sociabilite }}</td>
                                 <td>{{ $superieur->gout_risque }}</td>
                                 <td>{{ $superieur->autres_appreciations }}</td>

                                <td>
                                    <a href="{{ route('superieur.edit_appreciation', $superieur) }}" class="btn btn-primary btn-sm">Modifier une appréciation</a>
                                    <form action="{{route('superieur.destroy_appreciation', $superieur ->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer une appréciation</button>
                                    </form>
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
