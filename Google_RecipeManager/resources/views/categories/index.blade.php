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

@endsection