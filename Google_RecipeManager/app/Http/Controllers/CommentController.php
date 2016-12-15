<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

use App\Recipe;

class CommentController extends Controller
{
    public function store(Request $request) {

    	$comment = new Comment();

    	$comment->body = $request->body;

    	$comment->user_id = $request->user_id;

    	$comment->recipe_id = $request->recipe_id;

    	$comment->save();

    	$user = $comment->user;

    	return compact('comment', 'user');
    	
    }
}
