<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/register.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/register-complete.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
    new Vue({
        el: '#form-payment',
        data: {
            isToggleCreditCard: false,
            isTogglePaypal: false
        },
        methods: {
            toggleCreditCard: function () {
                this.isToggleCreditCard = true;
                this.isTogglePaypal = false;
            },
            togglePaypal: function () {
                this.isTogglePaypal = true;
                this.isToggleCreditCard = false;
            }
        }
    });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    Payment - BeLeave
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
    <div class="container">
        <div class="form-content">
            <div class="form-group text-center">
                <img src="/images/logo.png" class="logo" alt="logo website">
            </div>
            <div class="row text-center">
                <label>
                    Completed registration, you can sign in to dashboard for
                    management, update profile, generate link for subordinate or more.
                    <br><br>
                    Your package plan is A, price is 20.00 usd/month
                    <br>
                </label>
                <a href="#" class="btn btn-primary m-auto">Go to HomePage</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.form_account', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>