@extends('layout')

@section('title','| Recipe page')

@section('content')
	
	<div class="row">

        <div class="titleWrapper">
			
            <div class="customTitle">
				
                <h1>{{$recipe->name}}</h1>

                <p>View your favorite recipes ingredients!</p>

            </div>

        </div>

    </div> <!-- End of row class -->
  @if(DB::table('recipe_user')->where('recipe_id', '=', $recipe->id)->where('user_id','=',Auth::user()->id)->exists()) <!--  -->
     
    <button class="edit-modal btn btn-success" id="removeFavorite" data-id="{{ $recipe->id }}" data-name=" {{ $recipe->name }} " data-recipeId=" {{ $recipe->id }} ">

    <span class="glyphicon glyphicon-ok"></span> Successfully added!

    </button>

  @else

    <button class="edit-modal btn btn-primary" id="addFavorite" data-id="{{ $recipe->id }}" data-name=" {{ $recipe->name }} " data-recipeId=" {{ $recipe->id }} ">

    <span class="glyphicon glyphicon-add"></span> Add to favorites!

    </button>

  @endif

    <div class="row">
    	
    	<div class="col-md-12">

    	<ul>

    		@foreach ($ingredients as $ingredient)

				<h4> {{ $ingredient->name }} </h4>

				<li> {{ $ingredient->description }} </li>

    		@endforeach

    	</ul>

    	</div>

    </div>

    <hr>
    
    <div class="form-group row add">
      <input type="hidden" name="_token" value="{{ csrf_field() }}">
      <div class="col-md-5">
        <input type="text" class="form-control" id="body" name="body" placeholder="text body" required>
        <p class="error text-center alert alert-danger hidden">Your comment is empty</p>
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary" type="submit" id="addComment">
          <span class="glyphicon glyphicon-plus"></span> Add a new comment
        </button>
      </div>
    </div>

<!-- test section of comments!!!! -->
    <div class="commentWrapper">
    
    <?php $num=0; ?>

      <ul class="comment-list" style="opacity:1;">
        
        @foreach($rootComments as $comment)
          
          <?php $num++; ?>

            <li class="comment experiment" id="comment{{$num}}">
          
              <div class="comment-content clearfix">

                <div class="indicator"></div>
                
                <div class="avatar">
                  
                  <a href="#" class="user">
                    
                    <img src="http://www.gravatar.com/avatar/abdb59f1979c7849aa49821eac3afe68/?d=wavatar&s=200&r=g">
                    
                  </a>

                </div>

                <div class="comment-body">
                    
                  <header>
                    
                    <a class="authorName" href="#">{{$comment->user->name}}</a>

                  </header>

                  <div class="comment-body-inner">

                      <div class="comment-message">
                          
                          {{ $comment->body }}

                      </div>

                  </div>

                  <footer style="display:block;">
                        
                          <a href="#/" class="reply" onclick="document.getElementById('reply{{$num}}').style.display='block'" >Reply</a>

                  </footer>

                </div> <!-- end of comment-body -->

                <div class="reply-form-container" data-id="{{$num}}" id="reply{{$num}}">
                  
                  <div class="costumForm">
                    
                    <div class="formGroup commentbox">

                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      
                      <textarea id="textarea{{$num}}" class="form-control" wrap="hard" maxlength="500" placeholder="Leave a reply..." required></textarea>

                    </div>

                    <div class="pull-left">
                      
                      <button id="postBtn{{$num}}" onclick="replyFunction(this)" data-inorderId="{{$num}}" data-commentId="{{$comment->id}}" data-commenterId="{{$comment->user->id}}" type="submit" class="btn btn-success btn-sm">Post</button>

                      <button type="button" onclick="document.getElementById('reply{{$num}}').style.display='none'" class="btn btn-default btn-sm cancel">Cancel</button>

                    </div>

                  </div> <!-- end of costumForm -->

                </div> <!-- end of form container -->

                <div>
                  
                  <a id="childrenOf{{$num}}" onclick="viewMore(this)" data-inorderId="{{$num}}" data-commentId="{{$comment->id}}" class="viewMore" href="#\">view {{$comment->children->count()}} more replies</a>

                </div>
                

              </div>

            </li>

        @endforeach

      </ul>

    </div>
    <!-- end of the container of comments -->
    

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" role="form">
              <div class="form-group">
                <label class="control-label col-sm-2" for="userId">userId:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fuid">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="id">id:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fid" disabled>
                </div>
              </div>
            </form>
            <div class="deleteContent">
              Are you Sure you want to delete <span class="did"></span> ? <span
                class="hidden did"></span>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn actionBtn" data-dismiss="modal">
                <span id="footer_action_button" class='glyphicon'> </span>
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class='glyphicon glyphicon-remove'></span> Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
      

      $('#removeFavorite').on('click', function() {
          $.ajax({
              type: 'POST',
              url: '{{$recipe->id}}/delete',
              data: {
                'recipe_id': {{$recipe->id}},
                'user_id': {{ Auth::user()->id }} 
              },
              success: function(data) {
                $('#removeFavorite').replaceWith(`<button class="edit-modal btn btn-primary" id="addFavorite" data-id="{{ $recipe->id }}" data-name=" {{ $recipe->name }} " data-recipeId=" {{ $recipe->id }} "><span class="glyphicon glyphicon-add"></span> Add to favorites!</button>`);
                $('#addFavorite').attr('id','addFavorite');
              }
          });
      });

      $('#addFavorite').on('click', function() {
          $.ajax({
              type: 'POST',
              url: {{$recipe->id}},
              data: {
                'recipe_id': {{$recipe->id}},
                'user_id': {{ Auth::user()->id }}
              },
              success: function(data) {
                  $('#addFavorite').replaceWith(`<button class="edit-modal btn btn-success" id="removeFavorite" data-id="{{ $recipe->id }}" data-name=" {{ $recipe->name }} " data-recipeId=" {{ $recipe->id }} "><span class="glyphicon glyphicon-ok"></span> Successfully added!</button>`);
                  $('#removeFavorite').attr('id','removeFavorite');
              }
          });
      });


      $('#addComment').on('click', function() {

          $.ajax({

              type: 'POST',
              url: '{{$recipe->id}}/store',
              data: {
                'id': {{$num}},
                'recipe_id': {{$recipe->id}},
                'user_id': {{ Auth::user()->id }},
                'body': $('#body').val()
              },
              success: function(data) {
                {{$num++}}
                user = data.user;
                comment = data.comment;
                $('.comment-list').append('<li class="comment experiment" id="comment'+{{$num}}+'"><div class="comment-content clearfix"><div class="indicator"></div><div class="avatar"><a href="#" class="user"><img src="http://www.gravatar.com/avatar/abdb59f1979c7849aa49821eac3afe68/?d=wavatar&s=200&r=g"></a></div><div class="comment-body"><header><a class="authorName" href="#">'+user.name+'</a></header><div class="comment-body-inner"><div class="comment-message">'+comment.body+'</div></div><footer style="display:block;"><a href="#/" class="reply" onclick="document.getElementById('+"'"+'reply'+{{$num}}+''+"'"+').style.display='+"'"+'block'+"'"+'">Reply</a></footer></div> <!-- end of comment-body --><div class="reply-form-container" data-id="'+{{$num}}+'" id="reply'+{{$num}}+'"><div class="costumForm"><div class="formGroup commentbox"><input type="hidden" name="_token" value="'+1+'"><textarea id="textarea'+{{$num}}+'" class="form-control" wrap="hard" maxlength="500" placeholder="Leave a reply..." required></textarea></div><div class="pull-left"><button id="postBtn'+{{$num}}+'" onclick="replyFunction(this)" data-inorderId="'+{{$num}}+'" data-commentId="'+comment.id+'" data-commenterId="'+user.id+'" type="submit" class="btn btn-success btn-sm">Post</button><button type="button" onclick="document.getElementById('+"'"+'reply'+{{$num}}+''+"'"+').style.display='+"'"+'none'+"'"+'" class="btn btn-default btn-sm cancel">Cancel</button></div></div> <!-- end of costumForm --></div> <!-- end of form container --></div>');
              }
          });
      });

      function viewMore(myData) {
        console.log(myData);
        <?php $num++; ?>
        $.ajax({
          type: 'POST',
          url: '{{$recipe->id}}/viewMore',
          data: {
            'commentId': myData.getAttribute('data-commentId'),
            'num': {{$num}}
          }, 
          success: function(data) {
            $('#comment'+(myData.getAttribute('data-inorderId'))).append(data);
            $('#childrenOf'+(myData.getAttribute('data-inorderId')))[0].style.display="none";
          }
        });
      }

      function replyFunction(myData) {
        console.log(myData);
        
        $.ajax({
            type: 'POST',
            url: '{{$recipe->id}}/store',
            data: {
              'body': $('#textarea'+myData.getAttribute('data-inorderId')).val(),
              'parent_id': myData.getAttribute('data-commentid'),
              'recipe_id': {{ $recipe->id }},
              'user_id': {{ Auth::user()->id }} 
            },
            success: function(data) {
              console.log(data);
              {{$num++}}

              $('#comment'+(myData.getAttribute('data-inorderId'))).append('<li class="comment experiment" id="comment'+{{$num}}+'"><div class="comment-content clearfix"><div class="indicator"></div><div class="avatar"><a href="#" class="user"><img src="http://www.gravatar.com/avatar/abdb59f1979c7849aa49821eac3afe68/?d=wavatar&s=200&r=g"></a></div><div class="comment-body"><header><a class="authorName" href="#">'+data.user.name+'</a></header><div class="comment-body-inner"><div class="comment-message">'+data.comment.body+'</div></div><footer style="display:block;"><a href="#/" class="reply" onclick="document.getElementById('+"'"+'reply'+{{$num}}+''+"'"+').style.display='+"'"+'block'+"'"+'">Reply</a></footer></div> <!-- end of comment-body --><div class="reply-form-container" data-id="'+{{$num}}+'" id="reply'+{{$num}}+'"><div class="costumForm"><div class="formGroup commentbox"><input type="hidden" name="_token" value="'+1+'"><textarea id="textarea'+{{$num}}+'" class="form-control" wrap="hard" maxlength="500" placeholder="Leave a reply..." required></textarea></div><div class="pull-left"><button id="postBtn'+{{$num}}+'" onclick="replyFunction(this)" data-inorderId="'+{{$num}}+'" data-commentId="'+data.comment.id+'" data-commenterId="'+data.user.id+'" type="submit" class="btn btn-success btn-sm">Post</button><button type="button" onclick="document.getElementById('+"'"+'reply'+{{$num}}+''+"'"+').style.display='+"'"+'none'+"'"+'" class="btn btn-default btn-sm cancel">Cancel</button></div></div> <!-- end of costumForm --></div> <!-- end of form container --></div>');
            }
        });
      }


    </script>
  
@endsection
