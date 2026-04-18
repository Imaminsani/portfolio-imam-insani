<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'name' => 'Muhammad Imam Insani',
            'hero_title' => 'Membangun masa depan digital yang elegan.',
            'hero_subtitle' => 'Seorang Software Engineer yang berfokus pada performa, estetika, dan kode yang bersih.',
            'about_eyebrow' => 'Who I Am',
            'about_title' => 'Seni Mengubah Logika menjadi Visual.',
            'about_description' => "Dengan pengalaman lebih dari 2 tahun dalam pengembangan web, saya menggabungkan kekuatan backend **Laravel** dengan presisi frontend modern.\n\nSetiap proyek adalah kanvas bagi saya untuk menciptakan solusi yang skalabel, aman, dan memanjakan mata pengguna. Saya tidak hanya menulis kode; saya merancang pengalaman.",
            'profile_image' => 'profile.png',
            'github_url' => 'https://github.com',
            'linkedin_url' => 'https://linkedin.com',
        ]);
    }
}
