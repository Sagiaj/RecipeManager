@extends('layout')

@section('title', '| Profile page')

@section('content')

	<div class="row">
    	
    	<div class="table-responsive">
    		
    		<table class="table table-hover" id="table">
    		
				<tr>
					<th>No.</th>
					<th>Recipe name</th>
					<th># of comments</th>
				</tr>

				{{ csrf_field() }}

				<?php $num=1;; ?>

				@foreach ($favorites as $recipe)
			
						
						<tr id="favorite{{$num}}">
						
							<td> {{ $num++ }} </td>

	            			<td> <a href="\recipes\{{$recipe->id}}"><button class="btn btn-primary ">{{$recipe->name}}</button></a> </td>

							<td> {{ $recipe->comments()->count() }} </td>

							<td> <button data-recipe="{{$recipe->id}}" id="{{$num-1}}" class="btn btn-danger favorite">Remove favorite</button> </td>

						</tr>

			
					

				@endforeach

    		</table>

    	</div>

    </div>

    <script>
    	
    $('.favorite').on('click',function() {
    	console.log(this);
    	id = this.id;
    	recipeId = this.getAttribute('data-recipe');
    	$.ajax({
    		type: 'POST',
    		url: 'profile',
    		data: {
    			'id': id,
    			'user_id': 1,//Auth::user()->id
    			'recipe_id': recipeId

    		},
    		success: function(data) {
    			console.log(id);
    			$('#favorite'+id).remove();
    		}
    	});

    });

    </script>

@endsection