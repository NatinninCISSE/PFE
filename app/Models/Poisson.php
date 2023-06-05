<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poisson extends Model
{
    use HasFactory;

    protected $fillable = ['nom_poisson', 'description_poisson'];

    public function conseils()
{
    return $this->belongsToMany(Conseil::class);
}


public function steps()
{
    return $this->hasMany(Step::class);
}
    public function clients()
    {
        return $this->belongsToMany(Client::class);
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
