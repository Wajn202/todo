

<?php $__env->startSection('title'); ?>
    My Todo App
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row mt-3">
    <div class="col-12 align-self-center">
        <a href="<?php echo e(route('todo.create')); ?>" style="color: cornflowerblue; display:inline-block; margin-bottom:15px;">
            <span class="btn btn-primary">Create Todo</span>
        </a>

        <ul class="list-group">
            <?php $__currentLoopData = $todo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">
                    <a href="<?php echo e(route('todo.show', $item->id)); ?>" style="color: cornflowerblue"><?php echo e($item->title); ?></a>

                    <a href="<?php echo e(route('todo.edit', $item->id)); ?>" style="color: cornflowerblue; margin-left:10px;">Edit</a>

                    <form action="<?php echo e(route('todo.destroy', $item->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" style="color: cornflowerblue; background:none; border:none; cursor:pointer;">Delete</button>
                    </form>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\To-Do-app\resources\views/index.blade.php ENDPATH**/ ?>