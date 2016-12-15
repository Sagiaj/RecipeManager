@extends('layout')

@section('title','| Category recipes')

@section('content')

	<div class="row">

		<div class="col-md-12">

			<div class="jumbotron">
				
				<h1> {{ $category->name }} </h1>

			</div>

		</div>

	</div>

	<button class="edit-modal btn btn-primary" data-id="{{ $category->id }}" data-name=" {{ $category->name }} " data-categoryId=" {{ $category->id }} ">
    <span class="glyphicon glyphicon-add"></span> Add a new recipe(Soon to be implemented!)
    </button>

    <hr>

	<div class="row">
    	
    	<div class="table-responsive">
    		
    		<table class="table table-borderless" id="table">
    		
				<tr>
					<th>No.</th>
					<th>Recipe name</th>
					<th>Number of comments</th>
					<th>Action</th>
				</tr>

				{{ csrf_field() }}

				<?php $num=1;; ?>

				@foreach ($recipes as $recipe)
					
					<tr>
						
						<td> {{ $num++ }} </td>

						<td> <a href="\recipes\{{$recipe->id}}"><button class="btn btn-primary ">{{$recipe->name}}</button></a> </td>

						<td> {{ $recipe->comments()->count() }} </td>

						<td>
								
								<button class="delete-modal btn btn-danger" data-id="{{ $recipe->id }}" data-name=" {{ $recipe->name }} " data-recipeId=" {{ $recipe->id }} ">

		              			<span class="glyphicon glyphicon-trash"></span> Delete(Soon to be implemented!)</button>

						</td>

					</tr>

				@endforeach
				
    		</table>

    	</div>

    </div>

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

@endsection