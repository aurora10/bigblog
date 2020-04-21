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



        if (env('APP_ENV') === 'local') {

            $faker = \Faker\Factory::create();

            DB::table('users')->insert([

                [
                    'name'=>'John Doe',
                    'slug'=>'john-doe',
                    'email'=>'johndoe@test.com',
                    'password'=>bcrypt('secret'),
                    'bio'=> $faker->text(rand(250, 300))
                ],

                [
                    'name'=>'Jane Doe',
                    'slug'=>'jane-doe',
                    'email'=>'janedoe@test.com',
                    'password'=>bcrypt('secret'),
                    'bio'=> $faker->text(rand(250, 300))
                ],

                [
                    'name'=>'Rob Smith',
                    'slug'=>'rob-smith',
                    'email'=>'robsmith@test.com',
                    'password'=>bcrypt('secret'),
                    'bio'=> $faker->text(rand(250, 300))
                ],


            ]);
        }
        else {
            DB::table('users')->insert([

                [
                    'name'=>'Administrator',
                    'slug'=>'admin',
                    'email'=>'admin@admin.com',
                    'password'=>bcrypt('!Prodigy55'),
                    'bio'=> "I am Admin"
                ],


            ]);
        }


    }
}
