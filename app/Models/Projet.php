<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $primaryKey='id_projet';
    protected $fillable=[
        'user_id',
        'titre', 
        'description',
        'image',
        'lien_demo',
        'lien_github',
        'date_realisation',
    ];
    protected function casts(): array{
        return[
            'date_realisation'=> 'date',
        ];
    }
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
