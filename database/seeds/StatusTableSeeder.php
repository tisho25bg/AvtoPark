<?php

use Illuminate\Database\Seeder;

use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'id'    => 1,
            'type'  => 'Free'
        ]);

        Status::create([
            'id'    => 2,
            'type'  => 'OnRoad'
        ]);

        Status::create([
            'id'    => 3,
            'type'  => 'OnRepair'
        ]);
    }
}
