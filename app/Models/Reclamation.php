<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','objet_reclamation', 'description_reclamation'];

    public function administrateur()
    {
        return $this->belongsTo(administrateur::class);
    }

    public function client()
    {
        return $this->belongsTo(Dispositif::class);
    }
}
