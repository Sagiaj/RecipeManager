<?php echo $__env->make('partials._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


  <body>
<?php echo $__env->make('partials._nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <div class="container">


   <?php echo $__env->yieldContent('content'); ?>; 
  </div> 
  
    <?php echo $__env->make('partials._javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
     <meta name="_token" content="<?php echo e(csrf_token()); ?>">
	<script>$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')} })</script>
	
  </body>
</html>