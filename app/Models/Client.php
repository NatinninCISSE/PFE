<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function reclamations(){
        return $this->hasMany(Reclamations::class);
    }

    public function dispositifs(){
        return $this->hasMany(Dispositifs::class);
    }

    public function cultures()
    {
        return $this->belongsToMany(Culture::class, 'client_culture');
    }

    public function postes(){
        return $this->hasMany(Poste::class);
    }

    

}
