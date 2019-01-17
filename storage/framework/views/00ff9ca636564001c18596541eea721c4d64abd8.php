<?php $__env->startSection('content'); ?>
<?php
?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
       
        <div class="panel-body">
          <?php if(session('msg')): ?>
          <div class="alert alert-success">
            <?php echo e(session('msg')); ?>

          </div>
          <?php endif; ?>
           
          <table class="table table-striped table-hover">
            <?php $__empty_1 = true; $__currentLoopData = $allPdt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($pdt->title); ?></td>
              
              <td><a href="<?php echo e(url('/product-management/edit')); ?>/<?php echo e($pdt->id); ?>">Edit</a></td>
              <td><a href="<?php echo e(url('/product-management/delete')); ?>/<?php echo e($pdt->id); ?>">delete</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="8"><h1>No Data Found</h1></td>
            </tr>
            <?php endif; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>