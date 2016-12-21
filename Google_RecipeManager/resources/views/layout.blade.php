@include('partials._head')
@include('partials._javascript') 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <body>
@include('partials._nav')

<div id="wrapper">

	<div class="sidebar-wrapper">
	  
	    <ul class="sidebar-nav">
	    	<li>
		    	<div class="avatar">
	              
	              <a href="\profile">
	                
	                <img src="http://www.gravatar.com/avatar/abdb59f1979c7849aa49821eac3afe68/?d=wavatar&s=200&r=g">

	              </a>

	              <div class="innerAvatarInfo">
	              			
	          			<a href=""> <h3>{{ Auth::user()->name }}</h3> </a>

	              </div>

	              <div>
	              			
	          			<p style="color: white;">Have fun with my app, {{Auth::user()->name}}!</p>

	          	  </div>

	            </div>
	            
            </li>

	    	<hr>

	    	<li><a href="\profile"><i class="fa fa-envelope"></i>Profile page</a></li>

	    	<li><a href="\"><i class="fa fa-globe"></i>Categories page</a></li>
			
			<li><a href="http://localhost:8000/logout" onclick="event.preventDefault();
			 document.getElementById('logout-form').submit();">Logout</a>

	        <form id="logout-form" action="http://localhost:8000/logout" method="POST" style="display: none;">
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	            
	        </form></li>

	  	</ul>

	</div>

	<div class="container-fluid" id="page-content-wrapper">

		<div class="row">

			<div class="col-lg-12">

				@yield('content'); 
			
			</div>
			
		</div>
		

	</div> 

</div>
	
  @include('partials._javascript')
    
     <meta name="_token" content="{{ csrf_token() }}">
	<script>$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')} })</script>
	
  </body>
</html>