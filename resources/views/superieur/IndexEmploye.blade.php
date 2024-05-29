@extends('layouts.superieur')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste du personnel</div>

            <div class="card-body">
                <link href="{{ asset('css/index.css') }}" rel="stylesheet">
                <a href="{{ route('superieur.EmployeFormulaire') }}" class="btn btn-primary">Ajouter un employé</a>

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
                            <th>date_debut</th>
                             <th>localisation</th>
                             <th>Numéro urgence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employes as $employe)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employe->nom}}</td>
                                <td>{{ $employe->numero}}</td>
                                <td>{{ $employe->domaine}}</td>
                                <td>{{ $employe->date_debut}}</td>
                                 <td>{{ $employe->localisation}}</td>
                                 <td>{{ $employe->numero_urgence }}</td>
                                <td>
                                    <a href="{{ route('superieur.ModifEmploye', $employe) }}" class="btn btn-primary btn-sm">Modifier un  employe</a>
                                    <form action="{{route('superieur.destroyEmploye', $employe ->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
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
