<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Laravel Shop'); ?> - Laravel 电商教程</title>
    <!-- 样式 -->
    <link href="<?php echo e(mix('css/app.css')); ?>" rel="stylesheet">
</head>
<body>

<div id="app" class="<?php echo e(route_class()); ?>-page">
    <?php echo $__env->make('layouts._header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo $__env->make('layouts._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<!-- JS 脚本 -->
<script src="<?php echo e(mix('js/app.js')); ?>"></script>
<?php echo $__env->yieldContent('scriptAfterJs'); ?>
<!-- helpdesk 3 widget -->
<script type="text/javascript">
    (function(w, d, s, u) {
        w.id = 3; w.lang = ''; w.cName = ''; w.cEmail = ''; w.cMessage = ''; w.lcjUrl = u;
        var h = d.getElementsByTagName(s)[0], j = d.createElement(s);
        j.async = true; j.src = 'http://www.oss.com/js/jaklcpchat.js';
        h.parentNode.insertBefore(j, h);
    })(window, document, 'script', 'http://www.oss.com/');
</script>
<div id="jaklcp-chat-container"></div>
<!-- end helpdesk 3 widget -->
<div id="jaklcp-chat-container"></div>
<!-- end helpdesk 3 widget -->
</body>
</html>