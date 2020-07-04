<?php

use Illuminate\Database\Seeder;
use App\Models\ContactUs;
class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ContactUs::class, 200 )->create();

    }
}
