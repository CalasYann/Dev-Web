<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Place;

class PlaceFactory extends Factory
{

    protected $model = Place::class;
    
    public function definition(): array
    {

        $horaireOuverture = $this->faker->time($format = 'H:i:s');
        $horaireFermeture = $this->faker->time($format = 'H:i:s');

        return [
            'name' => $this->faker->city(),
            'type' => $this->faker->randomElement(['Loisir', 'Culture', 'Sport']),
            'description' => $this->faker->sentence(),
            'adresse' => $this->faker->address(),
            'affluence' => $this->faker->numberBetween(0, 5),
            'horaire_ouverture' => $horaireOuverture,
            'horaire_fermeture' => $horaireFermeture,
        ];
    }
}

