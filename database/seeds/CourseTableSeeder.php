<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseTableSeeder extends Seeder
{

    private $amount = 5;
    private $userID = 1;

    public function __construct(){}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < $this->amount; $i++)
        {
            DB::table('course')->insert([
                'name' => 'Course' . $i,
                'creator_id' => $this->userID,
                'description' => Str::random('20'),
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
        }
    }
}
