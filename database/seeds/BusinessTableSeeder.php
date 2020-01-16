<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business')->insert([
            'name'     => 'Acme Holdings',
            'address1' => '1 High Street',
            'city'     => 'Edinburgh',
            'postcode' => 'EH1 1SW',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
