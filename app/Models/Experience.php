<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model

{protected $primaryKey = 'id_experience';
      protected $fillable = [
         'user_id',
         'entreprise',
         'poste_ou_diplome',
         'date_debut' ,
         'date_fin', 
         'description',
    ];
    protected function casts(): array
    {
        return [
            'date_fin' => 'date',
            'date_debut' => 'date',
             
        ];
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
