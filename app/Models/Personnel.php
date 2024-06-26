<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personnel extends Model
{

    protected $table = 'personnel';
    use HasFactory;
    protected $fillable = [
        'nom', 
        'numero',
        'domaine',
        'localisation',
        'numero_urgence',
    ];
}
