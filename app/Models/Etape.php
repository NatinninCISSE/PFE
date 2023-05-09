<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    use HasFactory;

    public function cultures()
    {
        return $this->belongsToMany(Culture::class);
    }

    public function taches()
    {
        return $this->belongsToMany(tache::class);
    }

    public function conseils()
    {
        return $this->belongsToMany(conseil::class);
    }

}
