<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $sectionTypes = [
            ['name' => 'Text', 'code' => 'text'],
            ['name' => 'Url', 'code' => 'url'],
            ['name' => 'Image', 'code' => 'image'],
            ['name' => 'Multi Image', 'code' => 'multi_image'],
            ['name' => 'Video', 'code' => 'video'],
            ['name' => 'Hero', 'code' => 'hero'],
            ['name' => 'Feature', 'code' => 'feature'],
            ['name' => 'Call to Action (CTA)', 'code' => 'cta'],
            ['name' => 'Testimonial', 'code' => 'testimonial'],
            ['name' => 'FAQ', 'code' => 'faq'],
            ['name' => 'Pricing', 'code' => 'pricing'],
            ['name' => 'Team', 'code' => 'team'],
            ['name' => 'Services', 'code' => 'services'],
            ['name' => 'Portfolio', 'code' => 'portfolio'],
            ['name' => 'Contact', 'code' => 'contact'],
            ['name' => 'Map', 'code' => 'map'],
            ['name' => 'Countdown', 'code' => 'countdown'],
            ['name' => 'Progress', 'code' => 'progress'],
            ['name' => 'Custom', 'code' => 'custom'],
        ];


        foreach ($sectionTypes as $type) {
            DB::table('section_types')->insert([
                'name' => $type['name'],
                'code' => $type['code'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
