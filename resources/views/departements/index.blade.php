<div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
    <!-- index.blade.php -->

    @extends('layouts.app')

@section('content')
<div class="container">
    <div class = "row justify-content-center">
                <!-- <div class = "col-md-8">  -->
                <div class = "card">
                    <div class = "card-header">Liste des départements</div>

                    <div class = "card-body">


    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <!-- @if ($departements && count($departement) > 0)
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif -->
        <a href="/personnel/create" class="btn btn-primary">Ajouter un département</a>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th></th>
                    <th>Nom du département</th>
                    <th>Description du département</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($departements as $departement)
                    <tr>
                        <td>{{ $loop->iteration }}<td>

                        <td>{{ $departements->nom }}</td>
                        <td>{{ $departements->description }}</td>>
                        <td>
                            <br><br>
                            <!-- <a href="{{ route('departements.edit', $departement) }}" class="btn btn-sm btn-primary ">Modifier un etudiant</a><br><br>

                            Assurez-vous d'ajouter la route pour la suppression des étudiants également
                            <form action="{{ route('departements.destroy', $departement->id) }}" method="POST" style="display:inline;" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ">Supprimer</button> -->
                                <a href="{{route('departements.edit',$departement)}}" class="btn btn-primary btn-sm">Modifier un département</a>
                                <form action="{{ route('departements.destroy', $departement->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ">Supprimer un département</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    <!-- @else

    @endif -->
@endsection
