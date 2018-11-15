<?php $__env->startSection('title', '我的收藏'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">我的收藏</div>
                <div class="panel-body">
                    <div class="row products-list">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xs-3 product-item">
                                <div class="product-content">
                                    <div class="top">
                                        <div class="img">
                                            <a href="<?php echo e(route('products.show', ['product' => $product->id])); ?>">
                                                <img src="<?php echo e($product->image_url); ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="price"><b>￥</b><?php echo e($product->price); ?></div>
                                        <a href="<?php echo e(route('products.show', ['product' => $product->id])); ?>"><?php echo e($product->title); ?></a>
                                    </div>
                                    <div class="bottom">
                                        <div class="sold_count">销量 <span><?php echo e($product->sold_count); ?>笔</span></div>
                                        <div class="review_count">评价 <span><?php echo e($product->review_count); ?></span></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="pull-right"><?php echo e($products->render()); ?></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>