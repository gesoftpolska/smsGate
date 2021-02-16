<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesFill extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status();
        $status->name = "created";
        $status->save();

        $status = new Status();
        $status->name = "send";
        $status->save();

        $status = new Status();
        $status->name = "delivered";
        $status->save();
    }
}
