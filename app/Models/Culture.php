<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    use HasFactory;

    protected $fillable = ['nom_culture', 'description_culture','image_culture'];

    public function conseils()
{
    return $this->belongsToMany(Conseil::class);
}


public function etapes()
{
    return $this->hasMany(Etape::class);
}
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_culture');
    }

    public function dispositifs()
    {
        return $this->belongsToMany(Dispositif::class);
    }

    public function taches()
    {
        return $this->belongsToMany(Tache::class);
    }


}
