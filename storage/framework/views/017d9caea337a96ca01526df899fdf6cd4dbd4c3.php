<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                Laravel Shop
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <!-- 登录注册链接开始 -->
            <?php if(auth()->guard()->guest()): ?>
                <li><a href="<?php echo e(route('login')); ?>">登录</a></li>
                <li><a href="<?php echo e(route('register')); ?>">注册</a></li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e(route('cart.index')); ?>"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                        <img src="https://iocaffcdn.phphub.org/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/60/h/60" class="img-responsive img-circle" width="30px" height="30px">
                    </span>
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="<?php echo e(route('products.favorites')); ?>">我的收藏</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user_addresses.index')); ?>">收货地址</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                退出登录
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- 登录注册链接结束 -->
            </ul>
        </div>

    </div>
</nav>