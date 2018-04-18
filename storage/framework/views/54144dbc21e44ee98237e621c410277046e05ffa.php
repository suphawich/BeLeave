<?php $__env->startPush('style'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid" style="background-color: green; margin-top: 5px;">
        <h2>Hello</h2>
        <p>In this example, we have added a dropdown menu inside the sidebar.</p>
        <p>Notice the caret-down icon, which we use to indicate that this is a dropdown menu.</p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.go', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>