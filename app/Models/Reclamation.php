<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function administrateur()
    {
        return $this->belongsTo(administrateur::class);
    }

    public function dispositif()
    {
        return $this->belongsTo(Dispositif::class);
    }
}
