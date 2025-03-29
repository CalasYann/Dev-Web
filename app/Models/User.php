<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // Utilisation de Spatie pour les rôles

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Pas besoin d'avoir 'role' dans les attributs par défaut
    // protected $attributes = [
    //     'role' => 'simple',
    // ];

    // Cette méthode est inutile, Spatie prend en charge les rôles avec la méthode assignRole()
    // public function hasRole($role)
    // {
    //     return $this->role === $role;
    // }

    // Logique pour mettre à jour le rôle de l'utilisateur
    public function checkRankUpgrade()
    {
        $ranks = [
            'simple' => 0,
            'complexe' => 30, // Passe "complexe" à 100 XP
            'administrateur' => 70, // Passe "administrateur" à 300 XP
        ];

        foreach ($ranks as $rank => $xpRequired) {
            if ($this->xp >= $xpRequired) {
                // Utiliser Spatie pour assigner les rôles correctement
                $this->assignRole($rank); // Cette méthode sync les rôles de l'utilisateur
            }
        }

        $this->save();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}



