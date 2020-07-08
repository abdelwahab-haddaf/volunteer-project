<?php

use Illuminate\Database\Seeder;
use App\Models\Chat;
class ChatSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Chat::class, 200 )->create();
    }
}
