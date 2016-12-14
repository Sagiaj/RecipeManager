@include('partials._head')


  <body>
@include('partials._nav')

  <div class="container">


   @yield('content'); 
  </div> 
  
    @include('partials._javascript') 
     <meta name="_token" content="{{ csrf_token() }}">
	<script>$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')} })</script>
	
  </body>
</html>