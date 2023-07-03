<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositif extends Model
{
    use HasFactory;


    protected $fillable = ['nom_dispositif', 'description_dispositif', 'image_dispositif'];

    public function reclamations(){
        return $this->hasMany(Reclamation::class);
    }

    public function cultures()
    {
        return $this->belongsToMany(Culture::class, 'culture_dispositif');
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

}
