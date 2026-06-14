<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Initial admin login for the Filament panel (/admin).
        // Change the password immediately after first login.
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Site Admin',
                'password' => Hash::make('password'),
            ],
        );

        // Sensible default site settings.
        $defaults = [
            ['seo.default_title', 'Dr Sujay J — Cardiac & Cardiothoracic Surgeon', 'seo'],
            ['seo.default_description', 'Experienced cardiac surgeon specialising in CABG, valve replacement, and pediatric cardiac surgery.', 'seo'],
            ['stats.years_experience', 0, 'homepage'],
            ['stats.surgeries_performed', 0, 'homepage'],
        ];

        foreach ($defaults as [$key, $value, $group]) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }
    }
}
