@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Liste du personnel</div>

            <div class="card-body">
                <a href="/personnel/create" class="btn btn-primary">Ajouter un membre</a>
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
                        @foreach ($personnel as $person)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $person->nom }}</td>
                            <td>{{ $person->numero }}</td>
                            <td>{{ $person->domaine }}</td>
                            <td>{{ $person->localisation }}</td>
                            <td>{{ $person->numero_urgence }}</td>
                            <td>
                                <a href="{{ route('personnel.edit', $person->id) }}" class="btn btn-primary btn-sm">Modifier un membre</a>
                                <form action="{{ route('personnel.destroy', $person->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer un membre</button>
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
        return confirm("Êtes-vous sûr de vouloir supprimer ce membre ?");
    }
</script>
@endsection
