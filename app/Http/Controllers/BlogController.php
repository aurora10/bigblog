<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    protected $limit = 3;

    public function index() {

//    $categories = Category::with(['posts' => function($query) {
//
//        $query->published();
//
//    }])->orderBy('title', 'asc')->get();

//        \DB::enableQueryLog();
         $posts = Post::with('author', 'tags', 'category', 'comments')

             ->latestFirst()
             ->published()
             ->filter(request()->only(['term', 'month', 'year']))
             ->simplePaginate($this->limit);

         return view('blog.index', compact('posts'));
        //dd(\DB::getQueryLog());
    }


    public function category(Category $category) {

        $categoryName = $category->title;

//        $categories = Category::with(['posts' => function($query) {
//
//            $query->published();
//
//        }])->orderBy('title', 'asc')->get();

//        \DB::enableQueryLog();
//        $posts = Post::with('author')
//            ->latestFirst()
//            ->published()
//            ->where('category_id', $id)
//            ->simplePaginate($this->limit);

        $posts = $category->posts()

                            ->with('author', 'tags', 'category', 'comments')
                            ->latestFirst()
                            ->published()
                            ->simplePaginate($this->limit);

        return view('blog.index', compact('posts', 'categoryName'));
        //dd(\DB::getQueryLog());
    }

    public function tag(Tag $tag) {

        $tagName = $tag->title;


        $posts = $tag->posts()

            ->with('author', 'tags', 'comments')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        return view('blog.index', compact('posts', 'tagName'));

    }

    public function show(Post $post) {
//model injection method
        //$post = Post::published()->findOrFail($id);

        $post->increment('view_count');

        $postComments = $post->comments()->simplePaginate(6);

        return view('blog.show', compact('post', 'postComments'));

    }

     public function author(User $author) {

         $authorName = $author->name;



         $posts = $author->posts()

                            ->with('category', 'tags', 'comments ')
                            ->latestFirst()
                            ->published()
                            ->simplePaginate($this->limit);

         return view('blog.index', compact('posts', 'authorName'));


     }


}
