<?php

use App\Comment;
use App\Post;
use Illuminate\Database\Seeder;
use Faker\Factory;

class  CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $commments = [];

        $posts = Post::published()->latest()->take(5)->get();

        foreach ($posts as $post) {


            for ($i =0; $i <= rand(1, 10); $i++) {

                $commentDate = $post->published_at->modify("+{$i} hours");

                $commments[] = [
                    'author_name' => $faker->name,
                    'author_email' => $faker->email,
                    'author_url' => $faker->domainName,
                    'body' => $faker->paragraphs(rand(1,5), true),
                    'post_id' => $post->id,
                    'created_at' => $commentDate,
                    'updated_at' => $commentDate,
                ];
            }
        }

        Comment::truncate();
        Comment::insert($commments);
    }
}
