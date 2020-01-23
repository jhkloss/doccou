<?php

use App\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseTableSeeder extends Seeder
{

    private $amount = 10;
    private $userID = 1;

    public function __construct(){}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < $this->amount; $i++)
        {
            $Course = new Course();
            $Course->creator_id = $this->userID;
            $Course->name = $faker->words(3,true);
            $Course->description = $faker->sentences(2, true);
            $Course->save();
        }
    }
}
