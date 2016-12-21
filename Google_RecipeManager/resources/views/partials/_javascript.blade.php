<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

	
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script type="text/javascript">
    
    $(document).ready(function() {
      $('#addCategory').click(function() {
      	if($('categoryName').val()!==''){
      		console.log(this);
	        $.ajax({
	          url: '\categories/store',
	          type: 'POST',
	          data: {
	            'name': $('#categoryName').val()
	          },
	          success: function(data) {
	            $('#appendableCategory').append(`<a href="categories/`+data.id+`"><button class="customBtn" style="background-color: {{ sprintf('#%06X', mt_rand(0x5FFFFE, 0x600080)) }};"><span></span>`+data.name+` <hr> <div class="count">0</div></button></a>`);
	          }
	        });
      	}
      });
    });

  </script>

  
	
	