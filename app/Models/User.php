<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Log; 


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // Utilisation de Spatie pour les rôles

    protected $guard_name = 'web';

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
    /*public function checkRankUpgrade()
    {
        $ranks = [
            'simple' => 0,
            'complexe' => 1, // Passe "complexe" à 100 XP
            'administrateur' => 2, // Passe "administrateur" à 300 XP
        ];

        foreach ($ranks as $rank => $xpRequired) {
            if ($this->xp >= $xpRequired) {
                // Utiliser Spatie pour assigner les rôles correctement
                $this->assignRole($rank); // Cette méthode sync les rôles de l'utilisateur
            }
        }

        $this->save();
    }
*/
public function checkRankUpgrade()
{
    // Liste des rôles et le seuil d'XP pour les atteindre
    $ranks = [
        'simple' => 0,
        'complexe' => 1,  // Passe "complexe" à 100 XP
        'administrateur' => 2,  // Passe "administrateur" à 300 XP
    ];

    // Détermine le rôle à assigner en fonction de l'XP
    $assignedRole = 'administrateur';  // Par défaut, rôle simple

    foreach ($ranks as $rank => $xpRequired) {
        if ($this->xp >= $xpRequired) {
            $assignedRole = $rank;
        }
    }

    Log::info('Assigned Role: ' . $assignedRole);
    Log::info('User roles: ' . implode(', ', $this->getRoleNames()->toArray()));

    // Utiliser syncRoles pour mettre à jour les rôles
    $this->syncRoles([$assignedRole]);
    
    //$this->syncRoles(['administrateur']);
    $this->save();  // Sauvegarde l'utilisateur avec son nouveau rôle
}

protected static function boot()
{
    parent::boot();

    static::created(function ($user) {
        if (!$user->hasRole('simple')) {
            $user->assignRole('simple');
        }
    });
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


    public function edit(User $user)
{
    $roles = Role::all(); // Récupère tous les rôles
    return view('profile.admin_edit', compact('user', 'roles'));
}

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}



