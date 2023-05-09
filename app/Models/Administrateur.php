<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_admin',
        'prenom_admin',
        'mail_admin',
        'password_admin',
    ];

    public function reclamations(){
        return $this->hasMany(Reclamations::class);
    }
    
}
