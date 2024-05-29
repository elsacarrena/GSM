@extends('layouts.superieur')

@section('content')
<div class="container">

    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Liste des chefs de service</div>

            <div class="card-body">
                <link href="{{ asset('css/index.css') }}" rel="stylesheet">
                <a href="{{ route('superieur.ChefServiceFormulaire') }}" class="btn btn-primary">Ajouter un chef de service</a>

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
                            <th>date_fin</th>
                            <th>date_additionnelle</th>
                             <th>localisation</th>
                             <th>Numéro urgence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chefservice as $chefservices)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $chefservices->nom}}</td>
                                <td>{{ $chefservices->numero}}</td>
                                <td>{{ $chefservices->domaine}}</td>
                                <td>{{ $chefservices->date_debut}}</td>
                                <td>{{ $chefservices-> date_fin}}</td>
                                <td>{{ $chefservices->date_additionnelle}}</td>
                                 <td>{{ $chefservices->localisation}}</td>
                                 <td>{{ $chefservices->numero_urgence }}</td>
                                <td>
                                    <a href="{{ route('superieur.editChefservice', $chefservices, ['id'=>$chefservices->id])}}" class="btn btn-primary btn-sm">Modifier un  chef de service</a>
                                     {{--  <form action="{{route('chef_service.destroy', ['id'=>$chefservices->id]) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">  --}}
                                        <form action="{{ route('superieur.destroyChefservice', $chefservices->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">

                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-sm btn-danger">Supprimer un chef de service</button>

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
        return confirm("Êtes-vous sûr de vouloir supprimer cet chef de service ?");
    }
</script>

@endsection