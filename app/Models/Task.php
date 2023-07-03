<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    
    protected $fillable = ['step_id','nom_tache','description_tache','image_task'];

    public function cultures()
    {
        return $this->belongsToMany(Culture::class);
    }

    public function steps()
    {
        return $this->belongsTo(etape::class);
    }
}
