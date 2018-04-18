<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('css/users.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    Setting
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-data'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-methods'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid body-content">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-12 pl-0 pr-0" >
                <div class="card">
                    <div class="card-header">
                        <span>Features</span>
                    </div>
                    <div class="card-body">
                        <span>Request Supervisor</span>
                        <?php if($setting->r2sup): ?>
                            <a href="#" name="request" class="btn btn-light float-right">Cancel</a>
                        <?php elseif($setting->is_r2sup): ?>
                            <a href="#" name="request" class="btn float-right" style="cursor: no-drop;" disabled>Pending</a>
                        <?php else: ?>
                            <a href="pending-r2sup" name="request" class="btn btn-light float-right">Request</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.go', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>