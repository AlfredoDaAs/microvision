<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FTPSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('FTPSettings')->insert([
            	[
	            	'SettingName' => 'FTPAddress',
	             	'SettingValue' => ''
              	],
              	[
              		'SettingName' => 'FTPPort',
	             	'SettingValue' => ''
              	],
              	[
              		'SettingName' => 'FTPAdminUser',
	             	'SettingValue' => ''
              	],
              	[
              		'SettingName' => 'FTPAdminPwd',
	             	'SettingValue' => ''
              	]
        ]);
    }
}
