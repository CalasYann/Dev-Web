<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Object_Co;
use App\Models\Place;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();

        
        Object_Co::factory(15)->create(); // Crée 15 objets
        Place::factory(5)->create(); // Crée 5 lieux

        Role::firstOrCreate(['name' => 'simple']);
        Role::firstOrCreate(['name' => 'complexe']);
        Role::firstOrCreate(['name' => 'admin']);

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('simple'); // Par défaut, les utilisateurs sont simples
        });

        $this->call([
            RoleSeeder::class,
            // D'autres seeders si nécessaires
        ]);
        
    }
}
