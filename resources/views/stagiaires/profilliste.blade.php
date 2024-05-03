@extends('layouts.stagiaire')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste du personnel</div>

            <div class="card-body">
                <link href="{{ asset('css/index.css') }}" rel="stylesheet">
                <a href="/Personnels/create" class="btn btn-primary">Ajouter un PERSONNEL</a>

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
                            <th>type</th>
                            <th>groupe_sanguin</th>
                            <th>maladie</th>
                            <th>localisation</th>
                            <th>Nom Pere</th>
                             <th>Nom Mere</th>
                             <th>Numero Pere</th>
                             <th>Numero Mere</th>
                             <th>Numéro urgence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personnels as $personnel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $personnel->nom}}</td>
                                <td>{{ $personnel->numero}}</td>
                                <td>{{ $personnel->domaine}}</td>
                                <td>{{ $personnel->type}}</td>
                                <td>{{ $personnel->groupe_sanguin }}</td>
                                <td>{{ $personnel->maladie}}</td>
                                <td>{{ $personnel->localisation}}</td>
                                <td>{{ $personnel->nom_pere}}</td>
                                <td>{{ $personnel->nom_mere}}</td>
                                <td>{{ $personnel->numero_pere }}</td>
                                <td>{{ $personnel->numero_mere}}</td>
                                <td>{{ $personnel->numero_urgence }}</td>
                                <td>
                                    <a href="{{ route('Personnels.edit', $personnel) }}" class="btn btn-primary btn-sm">Modifier un  Personnel</a>
                                    <form action="{{ route('Personnels.destroy', $personnel ->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
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
