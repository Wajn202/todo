

<?php $__env->startSection('title'); ?>
    Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card text-center mt-5">
        <div class="card-header">
            <b>TODO DETAILS</b>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo e($todo->name); ?></h5>
            <p class="card-text"><?php echo e($todo->description); ?>.</p>
            <a href="edit/<?php echo e($todo->id); ?>"><span class="btn btn-primary">Edit</span></a>
            <a href="delete/<?php echo e($todo->id); ?>"><span class="btn btn-danger">Delete</span></a>
        </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\To-Do-app\resources\views/details.blade.php ENDPATH**/ ?>