@extends('layouts.app')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste des chefs de service</div>

            <div class="card-body">
                <link href="{{ asset('css/index_chefservice.css') }}" rel="stylesheet">
                <a href="{{ route('chef_service.create') }}" class="btn btn-primary">Ajouter un chef de service</a>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <hr>
                <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Numéro</th>
                            <th>Domaine</th>
                            <th>Localisation</th>
                            <th>Numéro durgence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chefs as $chef)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $chef->nom }}</td>
                                <td>{{ $chef->numero }}</td>
                                <td>{{ $chef->domaine }}</td>
                                <td>{{ $chef->localisation }}</td>
                                <td>{{ $chef->numero_urgence }}</td>
                                <td>
                                    <a href="{{ route('chef_service.edit', $chef) }}" class="btn btn-primary btn-sm">Modifier</a>
                                    <form action="{{ route('chef_service.destroy', $chef->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </div>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer ce chef de service ?");
    }
</script>

@endsection
