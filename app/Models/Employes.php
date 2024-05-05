<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employes extends Model
{
    protected $table = 'employes';
    use HasFactory;
    protected $fillable = [
        'nom',
        'numero',
        'domaine',
        'localisation',
        'numero_urgence',
    ];
}
