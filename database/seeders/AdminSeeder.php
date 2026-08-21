<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@sisarasa.com'],
            [
                'name' => 'Admin SisaRasa',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $admin->forceFill(['role' => 'admin'])->save();

        $this->command->info("Admin ready: {$admin->email} / password");
    }
}
