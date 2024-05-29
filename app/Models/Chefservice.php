<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chefservice extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom',
        'numero',
        'domaine',
        'date_debut',
        'date_fin',
        'date_additionnelle',
        'localisation',
        'numero_urgence',
        'users_id',
    ];
    protected $primaryKey= 'id';

    public function users(){
        return $this->belongsTo (User::class, 'users_id');

    }
}
