<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'id_contact';
    
    protected $fillable = [
        'user_id',
        'nom_expediteur', 
        'email_expediteur',
        'sujet',         // Correction : espace en trop (' sujet')
        'message', 
        'date_envoi',
        'notification',
        'lu',            // Correction : espaces en trop ('lu  ')
    ];

    protected function casts(): array
    {
        return [
            'lu' => 'boolean',            // Correction : espaces en trop (' lu' => ' boolean')
            'date_envoi' => 'datetime',   // Correction : 'date_envoie' corrigé en 'date_envoi'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}