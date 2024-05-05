<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chefservice extends Model
{
    protected $table = 'chefservice';
    use HasFactory;
    protected $fillable = [
        'nom',
        'numero',
        'domaine',
        'localisation',
        'numero_urgence',
    ];
}

