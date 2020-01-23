<?php

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
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
