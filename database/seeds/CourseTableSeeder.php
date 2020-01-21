<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->truncate();

        for($i = 0; $i < 5; $i++)
        {
            DB::table('course')->insert([
                'name' => 'Course' . $i,
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }
    }
}
