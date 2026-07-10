<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * The site was originally scaffolded for a cardiac surgeon. It is now a
 * cardiologist & pulmonologist practice, so the seeded surgical procedures and
 * the "surgeries performed" stat no longer apply.
 *
 * This removes only the exact rows the old seeder created (an untouched title
 * match) — anything the doctor has since added or renamed is left alone. The
 * replacement services are inserted by DatabaseSeeder.
 */
return new class extends Migration
{
    private const RETIRED_PROCEDURES = [
        'Coronary Artery Bypass Grafting (CABG)',
        'Heart Valve Repair & Replacement',
        'Angioplasty & Stenting',
        'Pediatric & Congenital Heart Surgery',
        'Minimally Invasive Cardiac Surgery',
        'Aortic Aneurysm Surgery',
    ];

    public function up(): void
    {
        DB::table('procedures')
            ->whereIn('title', self::RETIRED_PROCEDURES)
            ->delete();

        DB::table('settings')
            ->where('key', 'stats.surgeries_performed')
            ->delete();
    }

    public function down(): void
    {
        // Intentionally irreversible: re-seeding surgical procedures for a
        // cardiology practice would be wrong. Run the seeder to restore data.
    }
};
