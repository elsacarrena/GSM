
        {{--  <form action="{{ route('employe.update', $employe->id) }}" method="POST">  --}}
        {{--  <form action="{{ route('superieur.updateEmploye', $employe->id) }}" method="POST">  --}}
            @extends('layouts.superieur')

            @section('content')
                <div class="container">

                    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">

                    <div class="justify-content-center">
                        <div class="card">
                     <div class="card-header">Ajouter un nouveau chef de service</div>

                            <div class="card-body">
                                <hr>
                                <h1>Les champs avec <span class="required">*</span> sont obligatoires :</h1>

                      <form action="{{ route('superieur.updateEmploye', $employe->id) }}" method="POST">
                         {{--  <form action="{{ route('employe.update', $employe->id) }}" method="POST">  --}}
                        @csrf
                        @method('PUT')

                        <!-- Vos champs de formulaire pour les informations de létudiant à modifier -->
                        <div class="form-group">
                            <label for="nom">Votre nom <span class="required">*</span> </label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{$employe->nom }}" required>
                            {{--  <input type="text" name="nom" id="nom" class="form-control" value="{{$employe->nom }}" required>  --}}
                        </div>


                        <div class="form-group">
                            <label for="numero"> Votre numéro <span class="required">*</span> </label>
                            <input type="text" name="numero" id="numero" class="form-control" value="{{ $employe->numero}}" required>
                            {{--  <input type="text" name="numero" id="numero" class="form-control"  value="{{ $employe->numero}}" required>  --}}
                        </div>

                        <div class="form-group">
                            <label for="domaine"> Votre domaine de travail </label>
                            <input type="text" name="domaine" id="domaine" class="form-control"  value="{{$employe->domaine}}" required>
                            {{--  <input type="text" name="domaine" id="domaine" class="form-control"  value="{{$employe->domaine}}" required>  --}}
                        </div>
                        <div class="form-group">
                            <label for="date_debut">Date de prise de service : <span class="required">*</span></label>
                            <input type="date" name="date_debut" id="date_debut" class="form-control"  value="{{$employe->date_debut}}" required>

                            {{--  <input type="date" class="form-control" id="date_debut"value="{{$employe->date_debut }}" required>  --}}
                        </div>

                        <div class="form-group">
                            <label for="date_fin">Date de fin de service: <span class="required">*</span></label>
                            <input type="date" name="date_fin" id="date_debut" class="form-control"  value="{{$employe->date_fin}}" required>
                        </div>

                        <div class="form-group">
                            <label for="date_additionnelle">Date additionnelle: <span class="required">*</span></label>
                            <input type="date" name="date_additionnelle" id="date_additionnelle" class="form-control"  value="{{$employe->date_additionnelle}}" required>
                        </div>
                        <div class="form-group">
                            <label for="localisation"> Votre  Localisation <span class="required">*</span></label>
                            <input type="text" name="localisation" id="localisation" class="form-control" value="{{$employe->localisation}}" required>
                            {{--  <input type="text" name="localisation" id="localisation" class="form-control" value="{{$employe->localisation}}" required>  --}}
                        </div>

                        <div class="form-group">
                            <label for="numero_urgence"> Numéro à contacter en cas urgence <span class="required">*</span> </label>
                            <input type="text" name="numero_urgence" id="numero_urgence" class="form-control" value="{{$employe->numero_urgence}}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            @endsection
