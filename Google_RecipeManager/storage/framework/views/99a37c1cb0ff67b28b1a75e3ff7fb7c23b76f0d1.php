<?php $__env->startSection('title','| Recipe page'); ?>

<?php $__env->startSection('content'); ?>
	
	<div class="row">

        <div class="col-md-12">
			
            <div class="jumbotron">
				
                <h1><?php echo e($recipe->name); ?></h1>

                <p>View your favorite recipes ingredients!</p>

            </div>

        </div>

    </div> <!-- End of row class -->

	<button class="edit-modal btn btn-primary" data-id="<?php echo e($recipe->id); ?>" data-name=" <?php echo e($recipe->name); ?> " data-recipeId=" <?php echo e($recipe->id); ?> ">
    <span class="glyphicon glyphicon-add"></span> Add to favorites!
    </button>

    <div class="row">
    	
    	<div class="col-md-12">

    	<ul>

    		<?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

				<h4> <?php echo e($ingredient->name); ?> </h4>

				<li> <?php echo e($ingredient->description); ?> </li>

    		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    	</ul>

    	</div>

    </div>

    <hr>

    <div class="row">
    	
    	<div class="table-responsive">
    		
    		<table class="table table-hover" id="table">
    		
				<tr>
					<th>No.</th>
					<!--<th>User name</th>-->
					<th>Comment</th>
				</tr>

				<?php echo e(csrf_field()); ?>


				<?php $num=1;; ?>

				<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					
					<tr>
						
						<td> <?php echo e($num++); ?> </td>

						<td> <?php echo e($comment->body); ?> </td>

					</tr>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    		</table>

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
                <label class="control-label col-sm-2" for="userId">userId:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fuid">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="id">id:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fid" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="title">Title:</label>
                <div class="col-sm-10">
                  <input type="name" class="form-control" id="ftitle">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="body">Body:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fbody">
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



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>