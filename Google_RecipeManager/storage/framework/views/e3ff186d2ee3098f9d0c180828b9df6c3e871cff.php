<?php $__env->startSection('title', '| login'); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">

	  <div class="col-md-4 col-md-offset-4">

	    <div class="row">

	        <div class="col-md-12">

	            <a href="<?php echo e(url('google')); ?>" class="btn btn-lg btn-primary btn-block">

	                <strong>Login With Google</strong>

	            </a>

	        </div>

	    </div>

	  </div>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>