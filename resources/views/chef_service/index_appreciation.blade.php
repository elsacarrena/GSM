@extends('layouts.chefservice')

@section('content')
<div class="container">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">Liste des appréciations</div>
                    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
                    <a href="{{ route('chef_service.appreciation') }}" class="btn btn-primary">Ajouter une appréciation</a>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Domaine</th>
                                    <th>Ponctualité</th>
                                    <th>Assiduité</th>
                                    <th>Créativité</th>
                                    <th>Engagement</th>
                                    <th>Motivation</th>
                                    <th>Initiative</th>
                                    <th>Sociabilité</th>
                                    <th>Goût du risque</th>
                                    <th>Autres appréciations</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chefservices as $chefservice)
                                    <tr>
                                        <td>{{ $chefservice->nom }}</td>
                                        <td>{{ $chefservice->domaine }}</td>
                                        <td>{{ $chefservice->ponctualite }}</td>
                                        <td>{{ $chefservice->assiduite }}</td>
                                        <td>{{ $chefservice->creativite }}</td>
                                        <td>{{ $chefservice->engagement }}</td>
                                        <td>{{ $chefservice->motivation }}</td>
                                        <td>{{ $chefservice->initiative }}</td>
                                        <td>{{ $chefservice->sociabilite }}</td>
                                        <td>{{ $chefservice->gout_risque }}</td>
                                        <td>{{ $chefservice->autres_appreciations }}</td>
                                        <td>
                                            <a href="{{ route('chef_service.edit_appreciation', $chefservice->id) }}" class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('chef_service.destroy_appreciation', $chefservice->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
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
    </div>
</div>

<script>
        function confirmDelete() {
            return confirm("Êtes-vous sûr de vouloir supprimer cette appréciation ?");
        }
</script>
@endsection






