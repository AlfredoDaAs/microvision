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
        	'ID' => 1,
            'LoginName' => 'alfredo.davila@bringitps.com',
            'UserName' => 'AlfredoDA',
            'Password' => bcrypt('alfredo'),
            'ManufacturerID' => null,
            'Email' => 'alfredo.davila@bringitps.com',
            'StatusID' => null
        ]);
    }
}
