<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personnel extends Model
{

    protected $table = 'personnel';
    use HasFactory;
    protected $fillable = [
        'nom', // Ajoutez le champ 'nom' ici
        // Ajoutez d'autres champs qui doivent être remplis en masse ici
        'numero',
        'domaine',
        'groupe_sanguin',
        'maladie',
        'localisation',
        'nom_pere',
        'nom_mere',
        'numero_pere',
        'numero_mere',
        'numero_urgence',
    ];
}
