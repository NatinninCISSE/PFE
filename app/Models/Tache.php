<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    
    protected $fillable = ['etape_id','nom_tache','description_tache'];

    public function cultures()
    {
        return $this->belongsToMany(Culture::class);
    }

    public function etapes()
    {
        return $this->belongsTo(etape::class);
    }
}
