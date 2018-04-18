<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('css/users.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-data'); ?>
    isCopyUrl: false,
    isShowNewUser: false,
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-methods'); ?>
    clickNewUser: function () {
        this.isShowNewUser = true;
    },
    closeNewUser: function () {
        this.isShowNewUser = false;
    },
    copyToClipboard: function (event) {
        event.target.select();
        document.execCommand('copy');
        this.isCopyUrl = true;
        
    },
    clickAwayUrl: function () {
        this.isCopyUrl = false;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid body-content">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-12 pl-0 pr-0" >
                <div class="card">
                    <div class="card-header">
                        <span>Generate register link</span>
                        <a href="re-token" class="float-right"><i class="fa fa-refresh"></i></a>
                    </div>
                    <div class="card-body text-center">
                        <form method="post">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">url</span>
                            </div>
                            <input type="text" class="form-control" name="url" value="<?php echo e('localhost:7000/newuser/'.session()->get('token')); ?>" v-on:click="copyToClipboard">
                        </div>
                        <label class="copy-message" v-if="isCopyUrl">Copied text to clipboard</label>
                        <label class="copy-message" v-else><i class="fa fa-external-link"></i> Click to copy</label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pl-0 pr-0 mt-2">
                <button type="button" name="newUser" class="btn btn-light float-right mb-2" v-on:click="clickNewUser"><i class="fa fa-plus"></i> Add New User</button>
                <form method="post">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" name="search" placeholder="Search by Full Name, E-mail, Phone Number or Task">
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <form action="/user-create" method="post" >
                <?php echo csrf_field(); ?>
                <input type="hidden" name="supervisor_id" value="<?php echo e(session()->get('id')); ?>">
                <input type="hidden" name="company_name" value="<?php echo e(session()->get('company_name')); ?>">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">Full name</th>
                            <th scope="col" v-if="!isShowNewUser">Supervisor name</th>
                            <th scope="col">Task</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Phone number</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        <tr v-if="isShowNewUser">
                            
                            <td><input type="text" name="full_name" class="form-control" pattern="[A-Za-z][A-Za-z ]+" placeholder="Full name*" required></td>
                            
                            <td><input type="text" name="task" class="form-control" pattern="[A-Za-z][A-Za-z ]+" placeholder="Task*" required></td>
                            <td><input type="email" name="email" class="form-control" placeholder="Email address" required></td>
                            <td><input type="text" name="tel" class="form-control" pattern="[0-9][0-9+]+" placeholder="Phone Number" required></td>
                            <td>
                                <button type="cancel" name="save" class="btn btn-success mr-1" v-on:click="closeNewUser"><i class="fa fa-times"></i> Cancel</button>
                                <button type="submit" name="save" class="btn btn-secondary"><i class="fa fa-check-square-o"></i> Ok</button>
                            </td>
                        </tr>
                        <?php $__currentLoopData = $subordinates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subordinate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($subordinate->full_name); ?></td>
                                <td v-if="!isShowNewUser"><?php echo e($subordinate->supervisor_name ?? '-'); ?></td>
                                <td><?php echo e($subordinate->task ?? '-'); ?></td>
                                <td><?php echo e($subordinate->email); ?></td>
                                <td><?php echo e($subordinate->tel); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-2 ml-auto mr-auto mt-5">
                <?php echo e($subordinates->appends(['sort' => request()->sort])->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.go', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>