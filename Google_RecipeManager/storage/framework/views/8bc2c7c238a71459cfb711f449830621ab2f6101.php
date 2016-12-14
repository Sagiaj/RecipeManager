<?php $__env->startSection('title','| Main Page'); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-12">

            <div class="jumbotron">

                <h1>Main Page</h1>

                <p>Navigate through categories and choose your favorite recipes and share your opinions!</p>

            </div>

        </div>

    </div> <!-- End of row class -->


      <div class="form-group row add">

        <input type="hidden" name="_token" value="<?php echo e(csrf_field()); ?>">

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

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

            <div class="row">

                <div class="col-md-12">

                    <a href="categories/<?php echo e($category->id); ?>"><button class="btn btn-primary btn-lg btn-block"><span></span><?php echo e($category->name); ?> (<?php echo e($category->recipes()->count()); ?>)</button></a>
                    
                </div>
                    
                <div
                  class="fb-like"
                  data-share="true"
                  data-width="450"
                  data-show-faces="true">
                </div>
            </div>

            <hr>
        
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <?php echo $__env->yieldContent('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>