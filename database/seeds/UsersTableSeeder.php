<?php

use Illuminate\Database\Seeder;

class  UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();

        DB::table('users')->insert([

             [
                'name'=>'John Doe',
                'email'=>'johndoe@test.com',
                'password'=>bcrypt('secret')
            ],

            [
                'name'=>'Jane Doe',
                'email'=>'janedoe@test.com',
                'password'=>bcrypt('secret')
            ],

            [
                'name'=>'Rob Smith',
                'email'=>'robsmith@test.com',
                'password'=>bcrypt('secret')
            ],


        ]);
    }
}
