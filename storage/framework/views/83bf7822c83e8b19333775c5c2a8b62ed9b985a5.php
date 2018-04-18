<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
    <?php echo $__env->yieldContent('form'); ?>
    <?php echo $__env->yieldPushContent('script'); ?>
</body>
</html>
