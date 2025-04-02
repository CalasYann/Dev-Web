<?php

namespace Database\Factories;


use Carbon\Carbon;
use App\Models\Object_Co;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Object>
 */
class Object_CoFactory extends Factory
{
    protected $model = Object_Co::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['Électroménager', 'Lumière', 'Chauffage', 'Climatiseur']),
            'status' => $this->faker->randomElement(['en marche', 'éteint', 'Maintenance']),
            'location' => $this->faker->city(),
            'consommation_par_heure' => $this->faker->randomFloat(2, 0.1, 5.0), // en kWh
            'temps_total_allume' => 0, // en heures
            'temps_depuis_dernier_allumage' => 0, // en heures
            'last_status_changed_at' => Carbon::now()->subHours(rand(1, 100)),
            'nombre_interactions' => 0,
        ];
    }
}
