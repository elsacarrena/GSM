<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chefservice extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom', 'domaine', 'ponctualite', 'assiduite', 
        'creativite', 'engagement', 'motivation', 'initiative', 
        'sociabilite', 'gout_risque', 'autres_appreciations'
    ];
}
