<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class   PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();

        $posts = [];
        $faker = Factory::create();
        $date = Carbon::now()->modify('-1 year');
        //generate 10 dummy posts
        for ($i=1;$i<=36; $i++) {

            $image = "Post_Image_" . rand(1, 5) . ".jpg";
            $date->addDays(10);
            $published_date = clone($date);
            $createdDate = clone($date);

            $posts[] = [
                'author_id'=> rand(1,3),
                'title'=> $faker->sentence(rand(8, 12)),
                'excerpt'=> $faker->text(rand(250, 300)),
                'body'=> $faker->paragraphs(rand(10, 15), true),
                'slug'=> $faker->slug(),
                'image'=> rand(0,1) == 1 ? $image : NULL,
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
                'published_at' => $i > 30 ?  $published_date : (rand(0,1) == 0 ? NULL : $published_date->addDays( 4)),
                'view_count' => rand(1, 10) * 10



            ];
        }

        DB::table('posts')->insert($posts);

    }
}
