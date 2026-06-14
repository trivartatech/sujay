<?php

namespace Database\Seeders;

use App\Models\Procedure;
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

        // Standard cardiac procedures (published). Descriptions are generic and
        // intended for the client/doctor to review and refine.
        $procedures = [
            ['Coronary Artery Bypass Grafting (CABG)', 'Surgery to restore blood flow to the heart by bypassing blocked coronary arteries.'],
            ['Heart Valve Repair & Replacement', 'Repairing or replacing damaged heart valves to restore normal blood flow and heart function.'],
            ['Angioplasty & Stenting', 'A minimally invasive procedure to open narrowed or blocked coronary arteries.'],
            ['Pediatric & Congenital Heart Surgery', 'Specialised surgical care for children born with heart defects.'],
            ['Minimally Invasive Cardiac Surgery', 'Heart surgery performed through smaller incisions for faster recovery where appropriate.'],
            ['Aortic Aneurysm Surgery', 'Surgical treatment to repair a weakened or bulging section of the aorta.'],
        ];

        foreach ($procedures as $i => [$title, $summary]) {
            Procedure::firstOrCreate(
                ['title' => $title],
                ['summary' => $summary, 'is_published' => true, 'sort_order' => $i + 1],
            );
        }
    }
}
