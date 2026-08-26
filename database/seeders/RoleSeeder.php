<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Seed one demo account per user role (user, admin, mitra), so every
     * role is reachable locally without going through its registration flow.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $admin = User::firstOrCreate(
            ['email' => 'admin@sisarasa.com'],
            [
                'name' => 'Admin SisaRasa',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->forceFill(['role' => 'admin'])->save();

        $mitra = User::firstOrCreate(
            ['email' => 'mitra@sisarasa.com'],
            [
                'name' => 'Mitra SisaRasa',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $mitra->forceFill(['role' => 'mitra'])->save();
        $mitra->store()->firstOrCreate([], [
            'name' => 'Warung Berkah',
            'address' => 'Jl. Melati No. 5, Bandung',
            'latitude' => -6.9147,
            'longitude' => 107.6098,
        ]);

        $this->command->info('Demo accounts ready (password for all: "password"):');
        $this->command->info('  user  — test@example.com');
        $this->command->info('  admin — admin@sisarasa.com');
        $this->command->info('  mitra — mitra@sisarasa.com');
    }
}
