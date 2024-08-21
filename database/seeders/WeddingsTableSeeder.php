<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeddingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('weddings')->insert([
            'groom_name' => 'John Doe',
            'groom_father_name' => 'Robert Doe',
            'groom_mother_name' => 'Nancy Doe',
            'bride_name' => 'Jane Smith',
            'bride_father_name' => 'Michael Smith',
            'bride_mother_name' => 'Laura Smith',
            'ceremony_time' => '18:00:00',
            'ceremony_date' => '2024-08-18',
            'ceremony_location' => 'St. Patrick Church',
            'ceremony_coordinates' => json_encode([
                'longitude' => 106.84513,
                'latitude' => -6.21462
            ]),
            'reception_time' => '18:00:00',
            'reception_date' => '2024-08-18',
            'reception_location' => 'Grand Ballroom',
            'reception_coordinates' => json_encode([
                'longitude' => 106.84513,
                'latitude' => -6.21462
            ]),
            'story' => 'lorem ipsum dolor sit amet', 
            'user_id' => 1, 
        ]);

        DB::table('weddings')->insert([
            'groom_name' => 'Mark Johnson',
            'groom_father_name' => 'Peter Johnson',
            'groom_mother_name' => 'Susan Johnson',
            'bride_name' => 'Emily Davis',
            'bride_father_name' => 'James Davis',
            'bride_mother_name' => 'Patricia Davis',
            'ceremony_time' => '2024-09-25 11:00:00',
            'ceremony_date' => '2024-09-25 11:00:00',
            'ceremony_location' => 'Grace Cathedral',
            'ceremony_coordinates' => json_encode([
                'longitude' => 107.62123,
                'latitude' => -6.89734
            ]),
            'reception_time' => '2024-09-25 19:00:00',
            'reception_date' => '2024-09-25 19:00:00',
            'reception_location' => 'Luxury Hotel',
            'reception_coordinates' => json_encode([
                'longitude' => 107.62123,
                'latitude' => -6.89734
            ]),
            'story' => 'lorem ipsum dolor sit amet', 
            'user_id' => 1, 
        ]);
    }
}
