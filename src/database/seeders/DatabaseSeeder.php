<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShopsTableSeeder::class); 
        $this->call(UsersTableSeeder::class); 
        User::factory(20)->create();
        Reservation::factory(20)->create();
        Favorite::factory(20)->create();
        Rating::factory(100)->create();
        Review::factory(20)->create();
    }
}
