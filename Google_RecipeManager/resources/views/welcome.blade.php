@extends('layout')

@section('title','| Main Page')



@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="jumbotron">
            @if(Auth::check())
              You are signed in as {{ Auth::user()->name }}
            @else
              You are not signed in!
            @endif
                <h1>Main Page</h1>

                <p>Navigate through categories and choose your favorite recipes and share your opinions!</p>

            </div>

        </div>

    </div> <!-- End of row class -->

      <div class="form-group row add">

        <input type="hidden" name="_token" value="{{ csrf_field() }}">

        <div class="col-md-3">

          <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Category Name" required>

          <p class="error text-center alert alert-danger hidden"></p>

        </div>

        <div class="col-md-2">

          <button class="btn btn-primary" type="submit" id="addCategory">

            <span class="glyphicon glyphicon-plus"></span> Add a new category(Soon to be implemented!)

          </button>

        </div>

      </div>

    <hr>
    
    <div class="row">

        <div class="col-md-12">

            @foreach ($categories as $category)

            <div class="row">

                <div class="col-md-12">

                    <a href="categories/{{$category->id}}"><button class="btn btn-primary btn-lg btn-block"><span></span>{{ $category->name }} ({{ $category->recipes()->count() }})</button></a>
                    
                </div>

            </div>

            <hr>
        
            @endforeach
        </div>
    </div>



@endsection

@section('scripts')

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  @yield('scripts')

@endsection