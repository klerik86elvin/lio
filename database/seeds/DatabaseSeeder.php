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
        $this->call([ProjectSeeder::class]);
        DB::table('employees')->insert(
            [
                [
                    'name' => 'Ag',
                    'login' => 'agdevelopments',
                    'password' => bcrypt('AgDev1234'),
                    'department_id' => 1,
                    'email' => 'ag@test.com'
                ],
                [
                    'name' => 'Farida',
                    'login' => 'farida',
                    'password' => bcrypt('farida123'),
                    'department_id' => 1,
                    'email' => 'test@test.com'
                ],
                [
                    'name' => 'Elvir',
                    'login' => 'ibrahimli',
                    'password' => bcrypt('elvir123'),
                    'department_id' => 1,
                    'email' => 'test@test.com'
                ],
                [
                    'name' => 'Elvin',
                    'login' => 'mamedov',
                    'password' => bcrypt('elvin123'),
                    'department_id' => 1,
                    'email' => 'test@test.com'
                ],
                [
                    'name' => 'Farid',
                    'login' => 'farid',
                    'password' => bcrypt('farid123'),
                    'department_id' => 1,
                    'email' => 'test@test.com'
                ]
            ]
        );
        DB::table('departments')->insert([
            [
                'name' => 'IT'
            ],
            [
                'name' => 'Auditing'
            ]
        ]);
        // $this->call(UserSeeder::class);
        
    }
}
