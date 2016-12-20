@extends('layout')

@section('title','| Category recipes')

@section('content')

    <hr>
  
  	<button class="edit-modal btn btn-primary btn-block" data-categoryName="{{ $category->name }}" data-categoryId="{{ $category->id }}">

      <span class="glyphicon glyphicon-plus"></span> Add a new recipe</button>

      <hr>

        <button class="delete-modal btn btn-danger btn-block" data-categoryName="{{ $category->name }}" data-categoryId="{{ $category->id }}">

        <span class="glyphicon glyphicon-trash"></span> Delete Category {{ $category->name }}</button>

      <hr>

 

    <div class="row">

      <div class="col-lg-12" id="appendableRecipe">

        @foreach ($recipes as $recipe)
          
            <a href="\recipes/{{$recipe->id}}">
              <button class="customBtn" style="background-color: {{ sprintf('#%06X', mt_rand(0xAA1199, 0xAA2299)) }};"><span></span>{{ $recipe->name }}
                <hr>
                <div class="count">{{ $recipe->comments()->count() }}
                </div>
              </button>
            </a>

        @endforeach

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
                <label class="control-label col-sm-2" for="id">categoryId:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="{{$category->id}}" value="{{ $category->id }}"  disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="recipeName">Recipe Name:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="recipeName">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="ingredients">Ingredients:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ingredients">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="description">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="otherCategories">Other categories to attach:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="otherCategories">
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

    <script>
        
        $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.delete', function() {
      $.ajax({
        type: 'POST',
        url: '/categories/delete',
        data: {
          'id': {{$category->id}}
        },
        success: function(data) {
          console.log('deleted category', data);
        }
      });
    });

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Add");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Add');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#categoryId').val($(this).data('categoryid'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit',function() {
        $.ajax({
          url: '{{$category->id}}/addRecipe',
          type: 'POST',
          dataType: 'html',
          data: {
            'categoryId': {{$category->id}},
            'recipeName': $('input[id=recipeName]').val(),
            'description': $('input[id=description]').val(),
            'otherCategories': $('input[id=otherCategories]').val(),
            'ingredients': $('input[id=ingredients]').val(),
          },
          success: function(data) {
            data1 = JSON.parse(data);
            console.log(data1,data1.id,data1.name);
            $('#appendableRecipe').append(`<a href="/recipes/`+data1.id+`">
              <button class="customBtn" style="background-color: {{ sprintf('#%06X', mt_rand(0xAA1199, 0xAA2299)) }};"><span></span>`+data1.name+`<hr><div class="count">0</div></button></a>`);
          }
        });

    });

    </script>

@endsection