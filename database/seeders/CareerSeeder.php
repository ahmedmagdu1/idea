<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use Illuminate\Support\Str;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        if (Career::count() > 0) return;

        Career::create([
            'title' => 'Senior Graphic Designer',
            'slug' => Str::slug('Senior Graphic Designer'),
            'location' => 'Muscat',
            'type' => 'Full-time',
            'excerpt' => 'Lead creative design projects across branding and OOH.',
            'body' => 'We are looking for a passionate designer with 5+ years experience in branding and advertising.',
            'is_published' => true,
            'published_at' => now()->subDays(3),
        ]);

        Career::create([
            'title' => 'Digital Marketing Specialist',
            'slug' => Str::slug('Digital Marketing Specialist'),
            'location' => 'Remote / Oman',
            'type' => 'Full-time',
            'excerpt' => 'Own paid media and social performance across key platforms.',
            'body' => 'You will manage campaigns end-to-end with a focus on growth and analytics.',
            'is_published' => true,
            'published_at' => now()->subWeek(),
        ]);
    }
}

