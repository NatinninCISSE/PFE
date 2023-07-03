<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;


    protected $fillable = ['dispositif_id','nom_client','prenom_client','numero_client','adresse_client','password_client','description_dispositif','mail_client', 'image_client'];


    public function reclamations(){
        return $this->hasMany(Reclamation::class);
    }

    public function dispositifs(){
        return $this->belongTo(Dispositifs::class);
    }

    public function cultures()
    {
        return $this->belongsToMany(Culture::class, 'client_culture');
    }

    public function postes()
    {
        return $this->hasMany(Poste::class);
    }

    

}
