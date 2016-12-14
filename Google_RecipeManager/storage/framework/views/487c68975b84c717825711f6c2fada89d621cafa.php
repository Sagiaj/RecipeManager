<?php $__env->startSection('title','| Category recipes'); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">

		<div class="col-md-12">

			<div class="jumbotron">
				
				<h1> <?php echo e($category->name); ?> </h1>

			</div>

		</div>

	</div>

	<button class="edit-modal btn btn-primary" data-id="<?php echo e($category->id); ?>" data-name=" <?php echo e($category->name); ?> " data-categoryId=" <?php echo e($category->id); ?> ">
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

				<?php echo e(csrf_field()); ?>


				<?php $num=1;; ?>

				<?php $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					
					<tr>
						
						<td> <?php echo e($num++); ?> </td>

						<td> <a href="\recipes\<?php echo e($recipe->id); ?>"><button class="btn btn-primary "><?php echo e($recipe->name); ?></button></a> </td>

						<td> <?php echo e($recipe->comments()->count()); ?> </td>

						<td>
								
								<button class="delete-modal btn btn-danger" data-id="<?php echo e($recipe->id); ?>" data-name=" <?php echo e($recipe->name); ?> " data-recipeId=" <?php echo e($recipe->id); ?> ">

		              			<span class="glyphicon glyphicon-trash"></span> Delete(Soon to be implemented!)</button>

						</td>

					</tr>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				
    		</table>

    	</div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>