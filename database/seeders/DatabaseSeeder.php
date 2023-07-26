<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'suryadharmas',
            'gender' => 1,
            'is_admin' => 1,
            'is_banned' => 0,
            'datingCode' => '999',
            'dating_id' => 'ADM00101',
            'phoneNumber' => '87740580971',
            'birthDate' => '1979-06-09',
            'password' => Hash::make('12345'),
            'email' => 'adminsurya@gmail.com',
        ]);
        $this->call([
            LocationSeeder::class,
            VenueSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
