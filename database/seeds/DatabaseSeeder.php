<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call('BusinessTableSeeder');

        $this->call('UsersTableSeeder');

        $this->call('StudentTableSeeder');

        $this->call('StudentJobStatusTableSeeder');

        $this->call('BusinessStudentStatusTableSeeder');

        // enable foreign key check for this connection after running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
