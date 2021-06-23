<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'name'=>'Project 1',
                'department_id' => 1
            ],
            [
                'name'=>'Project 2',
                'department_id' => 1
            ],
            [
                'name'=>'Project 3',
                'department_id' => 2
            ],
            [
                'name'=>'Project 4',
                'department_id' => 2
            ],
            [
                'name'=>'Project 5',
                'department_id' => 2
            ]
        ]);
    }
}
