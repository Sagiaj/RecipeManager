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

        if(isset($request->parent_id)) 
            $comment->parent_id = $request->parent_id;

    	$comment->recipe_id = $request->recipe_id;

    	$comment->save();

    	$user = $comment->user;

    	return compact('comment', 'user');
    	
    }

    public function getChildren(Request $request) {
        $comment = Comment::find($request->commentId);

        $children = $comment->children;

        $childrenString = '<ul>';
        $request->num;
        foreach ($children as $child) {
            $request->num++;
            echo $request->num;
            $childrenString .= $child->getAppendString($request->num);

        }
        $number = $request->id;
        $childrenString .= '</ul>';

        return $childrenString;
    }
    

}
