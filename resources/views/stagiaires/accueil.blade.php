@extends('layouts.stagiaire')

@section('content')
    <link href="{{ asset('css/accueil.css') }}" rel="stylesheet">
    <div class="content">
        <img src="/logo.png" alt="Logo de l'entreprise" class="logo">
        <div class="presentation">
            <h1>Une Nouvelle Touche Pour Accompagner Le Sport Béninois!</h1>
            <h2>QUI SOMMES NOUS ?</h2>
            <p>
                Global Sports Management Est Une Agence De Marketing Et De Communication Spécialisée Dans Le Sport.
                Chaque jour, nous accompagnons le développement du sport béninois en allant souvent au-delà du champ d’action d’une agence de conseil en marketing.
                Un projet, des idées… Ecouter et comprendre vos besoins, concevoir les messages que vous attendez avec des créations que vous n’attendez pas, maîtriser les moyens de diffusion et mesurer les impacts.
                GSM vous conseille et vous accompagne dans l’élaboration et la mise en place de votre stratégie de communication.
            </p><hr>
            <h3>Notre Equipe</h3>
            <div class ="notre-equipe">
                <p>1-Fawaz ADJIBADE : CEO<br><br> 2-François ATCHIMAVO : Manager Général<br><br>3-Modéran AKITIKPA : Chef Service Production & Réalisation<br><br>4-Boris AKAN : Chef Service Média<br><br>5-FITILA Ravilia : Chef Service Informatique<br><br>6-AHLONSOU Sylvestre : Développeur Front-End<br><br>7-SITONDJI Ange : Développeur Back-End</p>
            </div>
        </div>
    </div>
@endsection
