<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('css/profile.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid profile-content">
        <form action="edit-profile" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value=<?php echo e(csrf_token()); ?>>
        <div class="row float-right d-none d-sm-none d-md-none d-lg-block">
            <button type="submit" class="btn btn-secondary mr-2" name="save">Save changes</button>
            <button type="reset" class="btn btn-success" name="cancel">Cancel</button>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 info-content">
                <div class="alert alert-danger" v-if="<?php echo e(isset($emailalready) ? $emailalready : 'false'); ?>">
                    <strong>E-mail is already, please try again.</strong>
                </div>
                
                <div class="form-group input-group">
                    <label class="form-topic">Current Password</label>
                    <input type="password" class="form-control form-field" name="current_password" pattern="[A-Za-z][A-Za-z ]+" placeholder="Current Password*" required>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 avatar-content text-center">
            </div>
        </div>
        <div class="row float-right d-block d-sm-block d-md-block d-lg-none d-xl-none submit-content">
            <button type="submit" class="btn btn-secondary mr-2" name="save2">Save changes</button>
            <button type="reset" class="btn btn-success" name="cancel2">Cancel</button>
        </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.go', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>