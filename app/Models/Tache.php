<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    public function cultures()
    {
        return $this->belongsToMany(Culture::class);
    }

    public function etapes()
    {
        return $this->belongsToMany(etape::class);
    }
}
