<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
class SmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        for($i=0; $i< 200; $i++){

            $sms = new \App\Sms();
            $sms->from = $faker->userName;
            $sms->phone = $faker->phoneNumber;
            $sms->text = $faker->text(160);
            $sms->status_id = $faker->numberBetween(1,3);
            $sms->save();


        }
    }
}
