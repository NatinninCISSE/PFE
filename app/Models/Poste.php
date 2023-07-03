<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','contenu_poste','image_poste'];


    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
}
