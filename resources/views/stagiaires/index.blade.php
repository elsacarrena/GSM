@extends('layouts.stagiaire')

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
                        @foreach ($stagiaires as $stagiaires)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stagiaires->nom}}</td>
                                <td>{{ $stagiaires->numero}}</td>
                                <td>{{ $stagiaires->domaine}}</td>
                                 <td>{{ $stagiaires->localisation}}</td>
                                 <td>{{ $stagiaires->numero_urgence }}</td>
                                <td>
                                    <a href="{{ route('stagiaires.edit', $stagiaires) }}" class="btn btn-primary btn-sm">Modifier un stagiaire</a>
                                    <form action="{{ route('stagiaires.destroy', $stagiaires ->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer un stagiaire</button>
                                    </form>



                                    {{-- <a href="{{ route('stagiaires.edit', $stagiaires->id) }}" class="btn btn-primary btn-sm">Modifier un  stagiaire</a>
                                    <form action="{{route('stagiaires.destroy', $stagiaires ->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer un stagiaire</button>
                                    </form> --}}
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
