@extends('layout')

@section('title','| Main Page')

@section('content')

      <div class="form-group row add">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-md-3">

          <input type="text" class="form-control" id="categoryName" name="name" placeholder="Category Name" required>

        </div>

        <div class="col-md-2">

          <button class="btn btn-primary" type="submit" id="addCategory">

            <span class="glyphicon glyphicon-plus"></span> Add a new category(Soon to be implemented!)

          </button>

        </div>

      </div>

      @if(count($errors->all()))

          @foreach ($errors->all() as $error)

          <ul>
            
            <p class="error text-center alert alert-danger hidden">

              <li> {{$error}} </li>

            </p>

          </ul>
            
          @endforeach

      @endif
  
    <hr>
    
    <div class="row">

      <div class="col-lg-12" id="appendableCategory">

        @foreach ($categories as $category)   
            
            <a href="categories/{{$category->id}}"><button class="customBtn" style="background-color: {{ sprintf('#%06X', mt_rand(0x5FFFFE, 0x600080)) }};"><span></span>{{ $category->name }} <hr> <div class="count">{{ $category->recipes()->count() }}</div></button></a>
            
        @endforeach

      </div>
      
    </div>   

@endsection

@section('scripts')

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  @yield('scripts')

@endsection