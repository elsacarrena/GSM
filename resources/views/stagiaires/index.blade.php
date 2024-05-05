
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste des stagiaires</div>

            <div class="card-body">
                <link href="{{ asset('css/index.css') }}" rel="stylesheet">
                <a href="{{ route('stagiaires.create') }}" class="btn btn-primary">Ajouter un stagiaire</a>
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
                            <th>numero</th>
                            <th>domaine</th>
                             <th>localisation</th>
                             <th>Numéro urgence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stagiaires as $stagiaire)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stagiaire->nom}}</td>
                                <td>{{ $stagiaire->numero}}</td>
                                <td>{{ $stagiaire->domaine}}</td>
                                 <td>{{ $stagiaire->localisation}}</td>
                                 <td>{{ $stagiaire->numero_urgence }}</td>
                                <td>
                                    <a href="{{ route('stagiaires.edit', $stagiaire) }}" class="btn btn-primary btn-sm">Modifier</a>
                                    <form action="{{route('stagiaires.destroy', $stagiaire->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
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
        return confirm("Êtes-vous sûr de vouloir supprimer cet personnel ?");
    }
</script>

@endsection
