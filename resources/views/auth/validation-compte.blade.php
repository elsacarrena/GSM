<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Définissez vos accès</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('files/css/bootstrap/css/bootstrap.min.css')}}"> --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            background-color: #1521c7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 110vh;
        }
        form {
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: 700;
            margin-bottom: 8px;
            display: block;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .text-danger {
            color: #c0392b;
        }
        .btn-container {
            text-align: center;
        }
        button[type="submit"] {
            background-color:#1521c7;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #2980b9;
        }

        .toggle-password1 {
            cursor: pointer;
            user-select: none;
            position: relative;
            left: 93%;
            top: -33px;
            transform: translateY(-50%);
            padding-left: 10px;
            height: 30px;
            border-left: 2px solid rgb(194, 192, 192);
        }
        .toggle-password1 i{
            margin-top: 8px;
        }
        .toggle-password2 {
            cursor: pointer;
            user-select: none;
            position: relative;
            left: 93%;
            top: -33px;
            transform: translateY(-50%);
            padding-left: 10px;
            height: 30px;
            border-left: 2px solid rgb(194, 192, 192);
        }
        .toggle-password2 i{
            margin-top: 8px;
        }
    </style>
</head>
<body>
    <form method="post" action="{{ route('submitDefiniAcces', $email) }}">
        @csrf
        @method('POST')
        <div class="box">
            <h1>Définissez vos accès</h1>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="{{ $email }}" readonly>
            </div>
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" id="code" name="code" value="{{ old('code') }}" required>
                @error('code')
                    <span class="text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="password @error('password') is-invalid @enderror" placeholder="Mot de passe" required />
                <span class="toggle-password1" onclick="togglePasswordVisibility()"><i class="fas fa-eye"></i></span>
                <div id="password-hints" class="text-muted  rules">

                </div>
                @error('password')
                    <span class="text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirm_password">Mot de passe de confirmation</label>
                <input type="password" id="confirm_password" name="confirm_password" class="password" placeholder="Confirmez le mot de passe" required>
                <span class="toggle-password2" onclick="togglePasswordVisibilityy()"><i class="fas fa-eye"></i></span>

                @error('confirm_password')
                    <span class="text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="btn-container">
                <button type="submit">Valider</button>
            </div>
        </div>
    </form>
</body>
<script>
    function togglePasswordVisibility() {
        var motDePasseInput = document.getElementById("password");
        var type = motDePasseInput.type === "password" ? "text" : "password";
        motDePasseInput.type = type;
    }
</script>
<script>
    function togglePasswordVisibilityy() {
        var motDePasseInput = document.getElementById("confirm_password");
        var type = motDePasseInput.type === "password" ? "text" : "password";
        motDePasseInput.type = type;
    }
</script>
<script>
    var passwordInput = document.getElementById('password');
    var confirmInput = document.getElementById('confirm_password');
    var submitButton = document.getElementById('submit');
    function updatePasswordHints() {
        var password = passwordInput.value;
        var passwordHints = [];

        // Vérifier si une lettre majuscule est présente
        if (!/[A-Z]/.test(password)) {
            passwordHints.push('- une lettre majuscule');
        }

        // Vérifier si une lettre minuscule est présente
        if (!/[a-z]/.test(password)) {
            passwordHints.push('- une lettre minuscule');
        }

        // Vérifieabsolute;i un chiffre est présent
        if (!/\d/.test(password)) {
            passwordHints.push('- un chiffre');
        }

        // Vérifier si un caractère spécial est présent (en incluant le point)
        if (!/[^A-Za-z0-9]/.test(password)) {
            passwordHints.push('- un caractère spécial');
        }


        // Vérifier si la longueur du mot de passe est inférieure au minimum requis
        if (password.length < 8) {
            var remainingLength = 8 - password.length;
            passwordHints.push('- '+ remainingLength + 'caractères supplémentaires');
        }

        // Afficher les indications à l'utilisateur si nécessaire
        if (passwordHints.length > 0) {
            var passwordHintsText = passwordHints.join('\n');
            document.getElementById('password-hints').innerText = 'Ajoutez au moins :\n' + passwordHintsText ;
            submitButton.disabled = true;
        } else {
            document.getElementById('password-hints').innerText = '';
            submitButton.disabled = false;
        }
    }
    passwordInput.addEventListener('input', updatePasswordHints);
</script>
</html>
