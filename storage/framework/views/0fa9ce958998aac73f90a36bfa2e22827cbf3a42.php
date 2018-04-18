<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
</head>
<body>
    <form id="form-login" method="get">
        <div class="container">
            <div class="form-content">
                <?php echo $__env->yieldContent('login'); ?>
            </div>
        </div>
    </form>
    <script src="/js/app.js" charset="utf-8"></script>
</body>
</html>
