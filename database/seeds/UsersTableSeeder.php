<?php

use App\Models\Business;
use Carbon\Carbon;
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
        $businessId = Business::first()->id;

        DB::table('users')->insert([
            'name' => 'employee1',
            'email' => 'employee1@acme.com',
            'password' => bcrypt('password123'),
            'business_id' => $businessId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'employee2',
            'email' => 'employee2@acme.com',
            'password' => bcrypt('password123'),
            'business_id' => $businessId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
