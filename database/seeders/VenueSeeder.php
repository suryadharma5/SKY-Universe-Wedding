<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0 ; $i <=9; $i++){
            Venue::create([
                // 'hospital_id' => $temp[0],
               'location_id' => mt_rand(1,3),
               'name' => $faker->company(),
               'location' => $faker->sentence(2),
               'price' => $faker->numberBetween($min = 1500, $max = 6000),
               'description' => $faker->sentence(20)
            ]);
        }
    }
}
