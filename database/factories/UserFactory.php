<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'prenom' => $this->faker->name(),
            'metier' => $this->faker->randomElement([
                'Développeur', 'Ingénieur', 'Médecin', 'Professeur', 
                'Artisan', 'Commerçant', 'Architecte', 'Designer'
            ]),
            'adresse' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'age' => $this->faker->numberBetween(18, 65),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'xp' => 0,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('simple'); // Assigner le rôle 'simple' après création
        });
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
