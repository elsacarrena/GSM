@extends('layouts.app')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste des employes</div>

            <div class="card-body">
                <link href="{{ asset('css/index1.css') }}" rel="stylesheet">
                <a href="{{ route('employe.create') }}" class="btn btn-primary">Ajouter un employe</a>
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
                        @foreach ($employes as $employe)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employe->nom }}</td>
                                <td>{{ $employe->numero }}</td>
                                <td>{{ $employe->domaine }}</td>
                                <td>{{ $employe->localisation }}</td>
                                <td>{{ $employe->numero_urgence }}</td>
                                <td>
                                    <a href="{{ route('employe.edit', $employe) }}" class="btn btn-primary btn-sm">Modifier</a>
                                    <form action="{{ route('employe.destroy', $employe->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
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
        return confirm("Êtes-vous sûr de vouloir supprimer cet employé ?");
    }
</script>

@endsection
