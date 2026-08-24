<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::where('is_admin', true)->exists()) {
            $this->command->info('An Administrator already exists. Seeding skipped.');
            return;
        }

        $name = $this->command->ask('Enter Admin Name', 'Admin User');
        $email = $this->command->ask('Enter Admin Email', 'admin@example.com');
        $password = $this->command->secret('Enter Admin Password') ?: '11111111';

        User::factory()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_admin' => true,
            'created_by' => null,
            'email_verified_at' => now(),
        ]);

        $this->command->info("Admin user '{$name}' ({$email}) successfully created.");
    }
}
