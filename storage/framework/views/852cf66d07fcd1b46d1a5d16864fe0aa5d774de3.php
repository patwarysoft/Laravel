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

               <form action="" method="get">
                  <table class="table table-striped table-hover">
                     <tr>
                        <td>
                           <label>Title</label>
                           <input type="text" name="title" />
                        </td>
                        <td>
                           <label>Start Date</label>
                           <input type="text" name="date1" />
                        </td>
                        <td>
                           <label>End Date</label>
                           <input type="text" name="date2" />
                        </td>
                        <td>
                           <label>Customer</label>
                           <select name="userid">
                              <option value="0">All Customers</option>
                              <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($usr->id); ?>"><?php echo e($usr->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                        </td>
                        <td>
                           <input type="submit" name="sub" value="Search" />
                        </td>
                     </tr>
                  </table>
               </form>
               <table class="table table-striped table-hover">
                  <?php $__empty_1 = true; $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                     <td><?php echo e($usr->name); ?></td>

                     <td><a href="<?php echo e(url('/account-management/edit')); ?>/<?php echo e($usr->id); ?>">Edit</a></td>
                     <td><a href="<?php echo e(url('/account-management/delete')); ?>/<?php echo e($usr->id); ?>">delete</a></td>
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