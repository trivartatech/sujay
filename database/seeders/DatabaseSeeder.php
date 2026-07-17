<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\LibrarySection;
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

        $this->settings();
        $this->services();
        $this->librarySections();
        $this->faqs();
    }

    private function settings(): void
    {
        $defaults = [
            ['seo.default_title', 'Dr. Sujay J — Cardiologist', 'seo'],
            ['seo.default_description', 'Consultant Cardiologist providing compassionate, evidence-based care for your heart health.', 'seo'],
            ['stats.years_experience', 0, 'homepage'],
            ['stats.patients_treated', 0, 'homepage'],
        ];

        foreach ($defaults as [$key, $value, $group]) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }
    }

    /**
     * The "Comprehensive Cardiac Care" strip. Summaries are generic and are
     * meant to be reviewed and refined by the doctor.
     */
    private function services(): void
    {
        $services = [
            ['Preventive Cardiology', 'shield-check', 'Risk assessment, screening and lifestyle guidance to prevent heart disease before it starts.'],
            ['Coronary Artery Disease', 'heart-artery', 'Diagnosis and treatment of narrowed or blocked coronary arteries, including angioplasty.'],
            ['Heart Failure Management', 'heart-failure', 'Long-term management to improve heart function, reduce symptoms and prevent hospitalisation.'],
            ['Arrhythmia Care', 'activity', 'Evaluation and treatment of irregular heart rhythms, palpitations and conduction disorders.'],
            ['Valvular Heart Disease', 'valve', 'Assessment and management of narrowed or leaking heart valves.'],
            ['Interventional Cardiology', 'syringe', 'Catheter-based procedures including angiography, angioplasty and stenting.'],
        ];

        foreach ($services as $i => [$title, $icon, $summary]) {
            Procedure::firstOrCreate(
                ['title' => $title],
                ['icon' => $icon, 'summary' => $summary, 'is_published' => true, 'sort_order' => $i + 1],
            );
        }
    }

    /**
     * The six Heart Health Library cards. Articles inside each section are
     * uploaded through the admin panel.
     */
    private function librarySections(): void
    {
        $sections = [
            ['Heart Conditions', 'Learn about different heart diseases.'],
            ['Symptoms', 'Understand common symptoms and when to seek help.'],
            ['Tests & Procedures', 'Know more about diagnostic tests and procedures.'],
            ['Prevention & Lifestyle', 'Adopt healthy habits to protect your heart.'],
            ['Medications', 'Information on common cardiac medications.'],
            ['Heart Health Articles', 'Read informative articles on heart health.'],
        ];

        foreach ($sections as $i => [$title, $description]) {
            LibrarySection::firstOrCreate(
                ['title' => $title],
                ['description' => $description, 'is_published' => true, 'sort_order' => $i + 1],
            );
        }
    }

    private function faqs(): void
    {
        $faqs = [
            ['What should I bring to my first consultation?', 'Please bring any previous medical records, ECG or echo reports, a list of current medications, and details of any allergies.'],
            ['How long does a consultation take?', 'A first consultation typically takes 20–30 minutes so there is enough time to review your history and answer your questions.'],
            ['Do I need a referral to book an appointment?', 'No referral is required. You can request an appointment directly through this website, by phone, or on WhatsApp.'],
            ['When should I see a cardiologist?', 'Consider a consultation if you experience chest discomfort, breathlessness, palpitations, dizziness, or if you have risk factors such as diabetes, high blood pressure, high cholesterol or a family history of heart disease.'],
        ];

        foreach ($faqs as $i => [$question, $answer]) {
            Faq::firstOrCreate(
                ['question' => $question],
                ['answer' => $answer, 'is_published' => true, 'sort_order' => $i + 1],
            );
        }
    }
}
