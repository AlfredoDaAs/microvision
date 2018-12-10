<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Manufacturer')->insert([
            'Description' => 'MicroVision',
            'StatusID' => 1,
            'IsAdmin' => 1
        ]);
    }
}
