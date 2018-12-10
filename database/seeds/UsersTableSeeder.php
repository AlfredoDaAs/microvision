<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('PortalUser')->insert([
            'LoginName' => 'alfredo',
            'UserName' => 'AlfredoDA',
            'Password' => bcrypt('alfredo'),
            'ManufacturerID' => 1,
            'Email' => 'alfredo.davila@bringitps.com',
            'StatusID' => 1
        ]);
    }
}
