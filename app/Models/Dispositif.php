<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositif extends Model
{
    use HasFactory;


    protected $fillable = ['nom_dispositif', 'description_dipositif'];
    

    public function reclamations(){
        return $this->hasMany(Reclamations::class);
    }

    public function cultures()
    {
        return $this->belongsToMany(Culture::class, 'culture_dispositif');
    }

}
