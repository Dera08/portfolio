<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'nom',
        'titre_professionnel',
        'bio',
        'email',
        'telephone',
        'photo_profil',
        'password',
        'liens_sociaux',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function contacts()
   {
    return $this->hasMany(Contact::class);
   }
   public function experiences(){
    return $this->hasMany(Experience ::class);
   }
   public function skills (){
    return $this->hasMany(Skill ::class);
   }
   public function projets(){
    return $this->hasMany(Projet ::class);
   }
   
}
