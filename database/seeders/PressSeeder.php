<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Press;
use Illuminate\Support\Str;

class PressSeeder extends Seeder
{
    public function run(): void
    {
        if (Press::count() > 0) return;

        Press::create([
            'title' => 'Launching Our New Digital Campaign',
            'slug' => Str::slug('Launching Our New Digital Campaign'),
            'excerpt' => 'We are excited to announce a multi-channel digital campaign across Oman.',
            'body' => 'Full details of our campaign, including strategy, channels, and expected outcomes.',
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);

        Press::create([
            'title' => 'IDEA GROUP Expands OOH Network',
            'slug' => Str::slug('IDEA GROUP Expands OOH Network'),
            'excerpt' => 'More premium screens added in key areas.',
            'body' => 'We added new digital screens and static billboards in high-traffic locations.',
            'is_published' => true,
            'published_at' => now()->subDays(12),
        ]);
    }
}

