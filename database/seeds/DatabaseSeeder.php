<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert(
            [
                [
                    'name' => 'Farida',
                    'login' => 'farida',
                    'password' => bcrypt('farida123'),
                    'department_id' => 1
                ],
                [
                    'name' => 'Elvir',
                    'login' => 'ibrahimli',
                    'password' => bcrypt('elvir123'),
                    'department_id' => 1
                ],
                [
                    'name' => 'Elvin',
                    'login' => 'mamedov',
                    'password' => bcrypt('elvin123'),
                    'department_id' => 1
                ],
                [
                    'name' => 'Farid',
                    'login' => 'farid',
                    'password' => bcrypt('farid123'),
                    'department_id' => 1
                ]
            ]
        );
        // $this->call(UserSeeder::class);
    }
}
