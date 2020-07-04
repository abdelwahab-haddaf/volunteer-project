<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(AdvertisementSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ContactUsSeeder::class);


    }
}
