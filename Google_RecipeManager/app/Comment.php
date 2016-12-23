<?php

namespace App;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Comment extends Model
{
    /**
	 * A comment can belong to one user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function user() {
    	return $this->belongsTo(User::class);
    }

    /**
	 * A comment can belong to one recipe.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function recipes() {
    	return $this->belongsTo(Recipe::class);
    }

    public function children() {
    	return $this->hasMany('App\Comment', 'parent_id', 'id');
    }

    

    public function getAppendString($num){
    	
    	return '<li class="comment experiment" id="comment'.$num.'">
          
		          <div class="comment-content clearfix">

		            <div class="indicator"></div>
		            
		            <div class="avatar">
		              
		              <a href="#" class="user">
		                
		                <img src="http://www.gravatar.com/avatar/abdb59f1979c7849aa49821eac3afe68/?d=wavatar&s=200&r=g">
		                
		              </a>

		            </div>

		            <div class="comment-body">
		                
		              <header>
		                
		                <a class="authorName" href="#">'.$this->user->name.'</a>

		              </header>

		              <div class="comment-body-inner">

		                  <div class="comment-message">
		                      
		                      '.$this->body.'

		                  </div>

		              </div>

		              <footer style="display:block;">
		                    
		                      <a href="#/" class="reply" onclick="document.getElementById('."'".'reply'.$num.''."'".').style.display='."'".'block'."'".'">Reply</a>

		              </footer>

		            </div> <!-- end of comment-body -->

		            <div class="reply-form-container" data-id="'.$num.'" id="reply'.$num.'">
		              
		              <div class="costumForm">
		                
		                <div class="formGroup commentbox">

		                	<input type="hidden" name="_token" value="'.csrf_token().'">
		                  
		                  <textarea id="textarea'.$num.'" class="form-control" wrap="hard" maxlength="500" placeholder="Leave a reply..." required></textarea>

		                </div>

		                <div class="pull-left">
		                  
		                  <button id="postBtn'.$num.'" onclick="replyFunction(this)" data-inorderId="'.$num.'" data-commentId="'.$this->id.'" data-commenterId="'.$this->user->id.'" type="submit" class="btn btn-success btn-sm">Post</button>

		                  <button type="button" onclick="document.getElementById('."'".'reply'.$num.''."'".').style.display='."'".'none'."'".'" class="btn btn-default btn-sm cancel">Cancel</button>

		                </div>

		              </div> <!-- end of costumForm -->

		            </div> <!-- end of form container -->

		          </div>
				  <div> 
		          	<a id="childrenOf'.$num.'" onclick="viewMore(this)" data-inorderId="'.$num.'" data-commentId="'.$this->id.'" class="viewMore" href="#\">view '.$this->children->count().' more replies</a>
		          </div>';
    }

    public function getChildComments($parentID) {
        $comments = DB::table('comments')->where('parent_id','=',$parentID)->get();
        return $comments;
    }

}
