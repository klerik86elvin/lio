<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('employees')->insert([
            [
                'name' => 'Kenan',
                'login' => 'kenan',
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'email' => 'kenan@mail.ru'
            ],
            [
                'name' => 'Yaqub',
                'login' => 'yaqub',
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'email' => 'yaqub@mail.ru'
            ],
            [
                'name' => 'Tural',
                'login' => 'tural',
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'email' => 'tural@mail.ru'
            ],
            [
                'name' => 'Elvin',
                'login' => 'elvin',
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'email' => 'elvin@mail.ru'
            ],

        ]);
    }
}
