@section('content')
    <div class="row container">
        <div class="col-12 col-md-8">
            <h2 class="">Ajouter un Employé</h2>
            <span class="section-intro">Veuillez remplir les informations nécessaires</span>

            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST" action="{{ route('organisateurs.store') }}">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label style="font-weight: 700;" for="setting-input-1" class="form-label">Nom</label>
                            <input style=" height:40px;"  type="text" class="form-control" id="setting-input-1" placeholder="Entrer le nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label style="font-weight: 700;" for="setting-input-2" class="form-label">Prénom</label>
                            <input style=" height:40px;" type="text" class="form-control" id="setting-input-2" placeholder="Entrer le prénom" name="prenom" value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label style="font-weight: 700;" for="setting-input-3" class="form-label">Email</label>
                            <input style=" height:40px;" type="email" class="form-control" id="setting-input-3" name="email" value="{{ old('email') }}" placeholder="Email" required>
                            @error('email')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div><!--//col-->
    </div><!--//row-->

@endsection
