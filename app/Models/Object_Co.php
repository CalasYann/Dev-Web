<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Object_Co extends Model
{
    use HasFactory;

    protected $table = 'object_cos';
    protected $fillable = ['name', 'type', 'status', 'location', 'consommation_par_heure', 'temps_total_allume', 'temps_depuis_dernier_allumage', 'last_status_changed_at', 'nombre_interactions'];
    protected $casts = ['last_status_changed_at' => 'datetime'];


    public function interaction(){
        $this->increment('nombre_interactions');
    }

    public static function getStatusOptions(){
        return ['en marche', 'éteint', 'Maintenance'];
    }

    public function setStatusAttribute($value)
    {
        if (!in_array($value, self::getStatusOptions())) {
            throw new \InvalidArgumentException("Statut invalide : {$value}");
        }

        if ($this->status !== $value) { // Changement de statut
            if ($this->status === 'en marche') {
                $this->mettreAJourTempsAllume();
            }

            if ($value === 'en marche') {
                $this->last_status_changed_at = now();
                $this->temps_depuis_dernier_allumage = 0;
            }
        }

        $this->attributes['status'] = $value;
    }

    private function mettreAJourTempsAllume()
    {
        if ($this->last_status_changed_at) {
            $lastChange = Carbon::parse($this->last_status_changed_at);
            $tempsEcoule = $lastChange->diffInSeconds(now());
            $this->temps_total_allume += $tempsEcoule;
            $this->temps_depuis_dernier_allumage = 0;
        }
    }

    public function getConsommationTotaleAttribute()
    {
        return ($this->consommation_par_heure * $this->temps_total_allume) / 3600; // Conversion en heures
    }
}


