<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsStoreRequest;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{
    public function store(Post $post, CommentsStoreRequest  $request) {
//        $data = $request->all();
//        $data['post_id'] = $post->id;
//
//        Comment::create($data);

        $post->createComment($request->all());

        return redirect()->back()->with('message', "Your comment was sent.");
    }
}
