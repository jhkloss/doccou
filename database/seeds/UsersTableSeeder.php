<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jan Kloß',
            'email' => 'mail@jkloss.de',
            'password' => Hash::make('12345'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 20; $i++)
        {
            $User = new User();
            $User->name = $faker->name;
            $User->email = $faker->unique()->email;
            $User->password = Hash::make('password');
            $User->save();
        }
    }
}
