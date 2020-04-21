<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        if (env('APP_ENV') === 'local') {
            DB::table('categories')->insert([

                [
                    'title'=>'Web Design',
                    'slug'=>'web-design'
                ],

                [
                    'title'=>'Web Programming',
                    'slug'=>'web-programming'
                ],

                [
                    'title'=>'Internet',
                    'slug'=>'internet'
                ],

                [
                    'title'=>'Socia  l Media Marketing',
                    'slug'=>'social-media-marketing'
                ],

                [
                    'title'=>'Photography',
                    'slug'=>'photography'
                ],

            ]);

        }

        else {

            DB::table('categories')->insert([


                'title'=>'Uncategorized',
                'slug'=>'uncategorized'
            ]);
        }





        $categories = Category::pluck('id');

        foreach (  Post::pluck('id') as $postId) {

            $categoryId = $categories[rand(0, $categories->count()-1)];

            DB::table('posts')
                ->where('id', $postId)
                ->update(['category_id' => $categoryId ]);
        }

    }
}
