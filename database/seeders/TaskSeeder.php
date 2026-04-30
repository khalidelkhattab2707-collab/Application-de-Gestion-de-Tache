<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // Créer 20 tâches aléatoires
        Task::factory(20)->create();

        // Créer 5 tâches spécifiques pour l'admin
        $admin = User::where('email', 'admin@test.com')->first();
        if ($admin) {
            Task::factory(5)->create([
                'user_id' => $admin->id,
            ]);
        }
    }
}