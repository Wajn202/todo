

<?php $__env->startSection('title'); ?>
    Add New Todo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row mt-3">
    <div class="col-12 align-self-center">
        <form action="<?php echo e(route('todo.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div>
                <label>name:</label>
                <input type="text" name="name" required>
            </div>
            <div style="margin-top:10px;">
                <label>Description:</label>
                <textarea name="description"></textarea>
            </div>
            <div style="margin-top:10px;">
                <button type="submit" style="color: cornflowerblue;">Save</button>
            </div>
        </form>

        <a href="<?php echo e(route('todo.index')); ?>" style="color: cornflowerblue; display:inline-block; margin-top:10px;">
            Back to List
        </a>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\To-Do-app\resources\views/create.blade.php ENDPATH**/ ?>