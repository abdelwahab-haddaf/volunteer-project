<?php

use Illuminate\Database\Seeder;
use App\Models\Advertisement;
class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Advertisement::class, 1 )->create();
    }
}
