<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    public function run()
    {

         // Vérifie si les rôles existent déjà avant de les créer
         $roles = ['simple', 'complexe', 'administrateur'];

         foreach ($roles as $roleName) {
             if (!Role::where('name', $roleName)->exists()) {
                 Role::create(['name' => $roleName, 'guard_name' => 'web']);
             }
         }
    }
}