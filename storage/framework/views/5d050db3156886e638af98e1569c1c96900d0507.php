<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('css/users.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    Request
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-data'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-methods'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid body-content">
        <div class="row">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">Request message</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($setting->is_r2sup): ?>
                                    <td><?php echo e($setting->full_name); ?><span> is request Supervisor.</span></td>
                                <?php endif; ?>
                                <td>
                                    <a href="/r2sup/accept/<?php echo e($setting->account_id); ?>" class="btn btn-light"><i class="fa fa-check"></i></a>
                                    <a href="/r2sup/decline/<?php echo e($setting->account_id); ?>" class="btn btn-light"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-2 ml-auto mr-auto mt-5">
                <?php echo $settings->render(); ?>

            </div>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.go', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>