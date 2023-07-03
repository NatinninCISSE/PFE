<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $fillable = ['poisson_id','nom_etape','description_etape','date_debut_etape','date_fin_etape','duree_etape', 'image_step'];
    

    public function poissons()
    {
        return $this->belongsTo(Poisson::class);
    }


}
