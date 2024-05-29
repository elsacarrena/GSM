@extends('layouts.stagiaire')

@section('content')
    <div class="container">

        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
        <form action="{{ route('stagiaires.update', $stagiaire->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Vos champs de formulaire pour les informations de létudiant à modifier -->
            <div class="form-group">
                <label for="nom">Votre nom </label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{$stagiaire->nom }}" required>
            </div>


            <div class="form-group">
                <label for="numero"> Votre numéro </label>
                <input type="text" name="numero" id="numero" class="form-control"  value="{{ $stagiaire->numero}}" required>
            </div>

            <div class="form-group">
                <label for="domaine"> Votre domaine de travail </label>
                <input type="text" name="domaine" id="domaine" class="form-control"  value="{{$stagiaire->domaine}}" required>
            </div>
            <div class="form-group">
                <label for="date_debut">Date de prise de service : <span class="required">*</span></label>
                <input type="date" name="date_debut" id="date_debut" class="form-control"  value="{{$stagiaire->date_debut}}" required>

                {{--  <input type="date" class="form-control" id="date_debut"value="{{$employe->date_debut }}" required>  --}}
            </div>

            <div class="form-group">
                <label for="date_fin">Date de fin de service: <span class="required">*</span></label>
                <input type="date" name="date_fin" id="date_debut" class="form-control"  value="{{$stagiaire->date_fin}}" required>
            </div>

            <div class="form-group">
                <label for="date_additionnelle">Date additionnelle: <span class="required">*</span></label>
                <input type="date" name="date_additionnelle" id="date_additionnelle" class="form-control"  value="{{$stagiaire->date_additionnelle}}" required>
            </div>
            <div class="form-group">
                <label for="localisation"> Votre  Localisation </label>
                <input type="text" name="localisation" id="localisation" class="form-control" value="{{$stagiaire->localisation}}" required>
            </div>

            <div class="form-group">
                <label for="numero_urgence"> Numéro à contacter en cas durgence </label>
                <input type="text" name="numero_urgence" id="numero_urgence" class="form-control" value="{{$stagiaire->numero_urgence}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection




