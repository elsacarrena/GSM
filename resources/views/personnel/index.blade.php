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
                            <th></th>
                            <th>Votre nom </th>
                            <th>Votre numéro</th>
                            <th> Votre domaine de travail</th>
                            <th> Votre groupe sanguin</th>
                            <th>Votre maladie spécifique </th>
                            <th>Votre localisation</th>
                            <th>Nom de votre père</th>
                            <th>Nom de votre mère </th>
                            <th>Numéro de votre père</th>
                            <th>Numéro de votre mère</th>
                            <th>Numéro à contacter en cas d'urgence</th>
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
                            <td>{{ $person->groupe_sanguin }}</td>
                            <td>{{ $person->maladie }}</td>
                            <td>{{ $person->localisation }}</td>
                            <td>{{ $person->nom_pere }}</td>
                            <td>{{ $person->nom_mere }}</td>
                            <td>{{ $person->numero_pere }}</td>
                            <td>{{ $person->numero_mere }}</td>
                            <td>{{ $person->numero_urgence }}</td>
                            <td>
                                <a href="{{ route('personnel.edit', $person->id) }}" class="btn btn-primary btn-sm">Modifier un membre</a>
                                <form action="{{ route('personnel.destroy', $person->id) }}" method="POST" style="display: inline;">
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
@endsection
