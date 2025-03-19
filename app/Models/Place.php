<?php

// app/Models/Place.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    // Spécifie les attributs qui sont autorisés à être assignés en masse
    protected $fillable = [
        'name',
        'type',
        'description',
        'adresse',
        'affluence',
        'horaire_ouverture',
        'horaire_fermeture',
    ];
     // Ajoute uniquement les champs qui doivent être assignés en masse
     protected $casts = [
        'horaire_ouverture' => 'string',
        'horaire_fermeture' => 'string',
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

