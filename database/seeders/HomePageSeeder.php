<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\PageSectionSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomePageSeeder extends Seeder
{
    public function run()
    {
        // Create Home Page
        $page = Page::create([
            'name' => 'Home',
            'slug' => 'home',
            'title' => 'Home - Cloudspace Solutions',
            'status' => true,
            'description' => 'Welcome to Cloudspace Solutions - Your Digital Growth Partner'
        ]);

        // Create SEO Settings
        $page->seo()->create([
            'meta_title' => 'Cloudspace Solutions - Digital Marketing & Web Development Agency',
            'meta_description' => 'Premium agency providing digital marketing, graphic design, web development, SEO, social media marketing, YouTube marketing, paid ads, reels & shorts.',
            'meta_keywords' => 'digital marketing, web development, SEO, social media marketing'
        ]);

        // 1. Hero Section
        $heroSection = $this->createSection($page, 'Hero Section', 'hero', 'video', [
            'heading' => 'Premium Agency',
            'subheading' => 'We Grow Brand Online',
            'description' => 'We provide digital marketing, graphic design, web development, SEO, social media marketing, YouTube marketing, paid ads, reels & shorts.',
            'button_1_text' => 'Our Service',
            'button_1_link' => '#',
            'button_2_text' => 'Get Free Quote',
            'button_2_link' => '#',
        ]);

        // Copy video file
        $this->copyFile(
            public_path('assets/frontend/media/pages/home/video/banner_video.mp4'),
            'page_images/sections/banner_video.mp4'
        );

        $heroSection->settings()->create([
            'key' => 'video',
            'value' => 'page_images/sections/banner_video.mp4',
            'value_type' => 'file'
        ]);

        // 2. Client Logo Section
        $logoSection = $this->createSection($page, 'Client Logos', 'client_logos', 'multi_image');

        $logos = [
            'harmony_travel_logo.jpg',
            'ncpl_logo.png',
            'nuvo_logo.jpg'
        ];

        $logoPaths = [];
        foreach ($logos as $logo) {
            $destination = 'page_images/sections/client_logos/' . $logo;
            $this->copyFile(
                public_path('assets/frontend/media/common/logo/client_logo/' . $logo),
                $destination
            );
            $logoPaths[] = $destination;
        }

        $logoSection->settings()->create([
            'key' => 'logos',
            'value' => json_encode($logoPaths),
            'value_type' => 'json'
        ]);

        // 3. Journey Section
        $journeySection = $this->createSection($page, 'Journey', 'journey', 'custom', [
            'title' => 'Begin Your Journey to Success Today',
            'subtitle' => "Here's the information you have been searching for"
        ]);

        $journeyCards = [
            [
                'number' => '1',
                'title' => 'Startup Kickstart',
                'description' => 'Affordable packages for small businesses and startups looking to grow quickly.',
                'button_text' => 'Get Service',
                'button_link' => '#',
                'image' => 'journey_1.png'
            ],
            [
                'number' => '2',
                'title' => 'Enterprise Expansion',
                'description' => 'Comprehensive services tailored for large-scale businesses.',
                'button_text' => 'Get Service',
                'button_link' => '#',
                'image' => 'journey_2.png'
            ],
            [
                'number' => '3',
                'title' => 'Custom Solutions',
                'description' => 'Flexible packages designed to fit unique needs and goals.',
                'button_text' => 'Get Service',
                'button_link' => '#',
                'image' => 'journey_3.png'
            ]
        ];

        foreach ($journeyCards as $index => $card) {
            $destination = 'page_images/sections/journey/' . $card['image'];
            $this->copyFile(
                public_path('assets/frontend/media/pages/home/images/' . $card['image']),
                $destination
            );
            $card['image'] = $destination;

            $journeySection->settings()->create([
                'key' => 'card_' . ($index + 1),
                'value' => json_encode($card),
                'value_type' => 'json'
            ]);
        }

        // 4. About Section
        $this->createSection($page, 'About', 'about', 'text', [
            'title' => 'ABOUT CLOUDSPACE SOLUTIONS',
            'button_text' => 'OUR SERVICE',
            'button_link' => '#'
        ]);

        // 5. Stats Section
        $this->createSection($page, 'Stats', 'stats', 'custom', [
            'stats' => json_encode([
                ['value' => '5+', 'label' => 'EXPERIENCE'],
                ['value' => '39+', 'label' => 'PROJECTS'],
                ['value' => '23', 'label' => 'CLIENT'],
                ['value' => '98%', 'label' => 'SUCCESS RATE']
            ])
        ]);

        // 6. Testimonials Section
        $this->createSection($page, 'Testimonials', 'testimonials', 'custom', [
            'title' => 'WHAT OUR CLIENTS LOVE ABOUT OUR SERVICES'
        ]);

        // 7. Consultation Section
        $this->createSection($page, 'Consultation', 'consultation', 'text', [
            'button_text' => 'SCHEDULE A FREE CONSULTATION',
            'button_link' => '#'
        ]);
    }

    private function createSection($page, $name, $code, $type, $settings = [])
    {
        $section = $page->sections()->create([
            'name' => $name,
            'code' => $code,
            'type' => $type,
            'status' => true
        ]);

        foreach ($settings as $key => $value) {
            $section->settings()->create([
                'key' => $key,
                'value' => $value,
                'value_type' => is_array($value) || is_object($value) ? 'json' : 'text'
            ]);
        }

        return $section;
    }

    private function copyFile($source, $destination)
    {
        if (File::exists($source)) {
            $destinationPath = Storage::disk('public')->path($destination);
            File::ensureDirectoryExists(dirname($destinationPath));
            File::copy($source, $destinationPath);
        }
    }
}
