<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomFieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customField = [
            ['name' => 'Text Field', 'code' => 'text_field'],
            ['name' => 'Textarea', 'code' => 'textarea'],
            ['name' => 'Number Field', 'code' => 'number_field'],
            ['name' => 'Email Field', 'code' => 'email_field'],
            ['name' => 'URL Field', 'code' => 'url_field'],
            ['name' => 'Date Field', 'code' => 'date_field'],
            ['name' => 'Time Field', 'code' => 'time_field'],
            ['name' => 'DateTime Field', 'code' => 'datetime_field'],
            ['name' => 'Select / Dropdown', 'code' => 'select_dropdown'],
            ['name' => 'Radio Button', 'code' => 'radio_button'],
            ['name' => 'Checkbox', 'code' => 'checkbox'],
            ['name' => 'File Upload', 'code' => 'file_upload'],
            ['name' => 'Password Field', 'code' => 'password_field'],
            ['name' => 'Color Picker', 'code' => 'color_picker'],
            ['name' => 'Checkbox', 'code' => 'checkbox'],
        ];


        foreach ($customField as $custom) {
            DB::table('custom_field_types')->insert([
                'name' => $custom['name'],
                'code' => $custom['code'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
