<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    use HasFactory;
    protected $fillable = ['culture_id','poisson_id','nom_etape','description_etape','date_debut_etape','date_fin_etape','duree_etape', 'image_etape'];
    
    
    public function cultures()
    {
        return $this->belongsTo(Culture::class);
    }


    public function poissons()
    {
        return $this->belongsTo(Poisson::class);
    }

    public function taches()
    {
        return $this->hasMany(tache::class);
    }

    public function conseils()
    {
        return $this->belongsToMany(conseil::class);
    }

}
