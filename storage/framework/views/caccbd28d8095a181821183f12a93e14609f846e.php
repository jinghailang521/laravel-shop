<?php $__env->startSection('title', '商品列表'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- 筛选组件开始 -->
                <div class="row">
                    <form action="<?php echo e(route('products.index')); ?>" class="form-inline search-form">
                        <input type="text" class="form-control input-sm" name="search" placeholder="搜索">
                        <button class="btn btn-primary btn-sm">搜索</button>
                        <select name="order" class="form-control input-sm pull-right">
                            <option value="">排序方式</option>
                            <option value="price_asc">价格从低到高</option>
                            <option value="price_desc">价格从高到低</option>
                            <option value="sold_count_desc">销量从高到低</option>
                            <option value="sold_count_asc">销量从低到高</option>
                            <option value="rating_desc">评价从高到低</option>
                            <option value="rating_asc">评价从低到高</option>
                        </select>
                    </form>
                </div>
                <!-- 筛选组件结束 -->
                <div class="row products-list">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xs-3 product-item">
                            <div class="product-content">
                                <div class="top">
                                    <div class="img">
                                        <a href="<?php echo e(route('products.show',['product' => $product->id])); ?>">
                                            <img src="<?php echo e($product->image_url); ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="price"><b>￥</b><?php echo e($product->price); ?></div>
                                    <div class="title">
                                        <a href="<?php echo e(route('products.show',['product' => $product->id])); ?>">
                                            <?php echo e($product->title); ?>

                                        </a>
                                    </div>
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
<?php $__env->startSection('scriptAfterJs'); ?>
    <script>
        var filters = <?php echo json_encode($filters); ?>;
        $(document).ready(function () {
            $('.search-form input[name=search]').val(filters.search);
            $('.search-form select[name=order]').val(filters.order);
            $('.search-form select[name=order]').on('change', function() {
                $('.search-form').submit();
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>