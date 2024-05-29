<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom',
        'numero',
        'domaine',
        'date_debut',
        
        'localisation',
        'numero_urgence',


    ];
}
