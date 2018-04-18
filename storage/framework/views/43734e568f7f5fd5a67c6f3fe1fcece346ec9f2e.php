<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('css/users.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    Leave
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-data'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-methods'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid body-content">
        <div class="row">
            
            <?php echo Form::open(['action' => 'ManageController@takeLeave', 'method' => 'PUT']); ?>

            <div class="col-12">
                <div class="form-group input-group">
                    <label>Leave type</label>
                    <?php echo Form::select('leave_type', ['Vacation' => 'Vacation leave', 'Personal Errand' => 'Personal errand leave', 'Sick' => 'Sick leave'], null,['class' => 'form-control']); ?>

                </div>
                <div class="form-group input-group">
                    
                    <label>Depart date</label>
                    <?php echo e(Form::date('depart_at', \Carbon\Carbon::now(), ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group input-group">
                    
                    <label>Arrive date</label>
                    <?php echo e(Form::date('arrive_at', null, ['class' => 'form-control'])); ?>

                </div>
                <?php echo e(Form::submit('Click Me!', ['class' => 'btn btn-light'])); ?>

            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.go', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>