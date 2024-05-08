<?php

namespace App\Models;
// use App\Models\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profilchefservice extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'numero' ,
        'domaine' ,
         'groupe_sanguin' ,
        'maladie' ,
        'localisation' ,
         'nom_pere' ,
         'nom_mere',
        'numero_pere' ,
         'numero_mere',
        'numero_urgence',
        'users_id',
    ];

    protected $primaryKey= 'idProfilchefservice';

    public function users(){
        return $this->belongsTo (User::class, 'users_id');
    }
}

