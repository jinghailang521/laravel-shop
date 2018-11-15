<?php $__env->startSection('title', $product->title); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-body product-info">
                <div class="row">
                    <div class="col-sm-5">
                        <img class="cover" src="<?php echo e($product->image_url); ?>" alt="">
                    </div>
                    <div class="col-sm-7">
                        <div class="title"><?php echo e($product->title); ?></div>
                        <div class="price"><label>价格</label><em>￥</em><span><?php echo e($product->price); ?></span></div>
                        <div class="sales_and_reviews">
                            <div class="sold_count">累计销量 <span class="count"><?php echo e($product->sold_count); ?></span></div>
                            <div class="review_count">累计评价 <span class="count"><?php echo e($product->review_count); ?></span></div>
                            <div class="rating" title="评分 <?php echo e($product->rating); ?>">评分 <span class="count"><?php echo e(str_repeat('★', floor($product->rating))); ?><?php echo e(str_repeat('☆', 5 - floor($product->rating))); ?></span></div>
                        </div>
                        <div class="skus">
                            <label>选择</label>
                            <div class="btn-group" data-toggle="buttons">
                                <?php $__currentLoopData = $product->skus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label
                                            class="btn btn-default sku-btn"
                                            title="<?php echo e($sku->description); ?>"
                                            data-price="<?php echo e($sku->price); ?>"
                                            data-stock="<?php echo e($sku->stock); ?>"
                                            data-toggle="tooltip"
                                            title="<?php echo e($sku->description); ?>"
                                            data-placement="bottom">
                                        <input type="radio" name="skus" autocomplete="off" value="<?php echo e($sku->id); ?>"> <?php echo e($sku->title); ?>

                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="cart_amount"><label>数量</label><input type="text" class="form-control input-sm" value="1"><span>件</span><span class="stock"></span></div>
                        <div class="buttons">
                            <button class="btn btn-success btn-favor">❤ 收藏</button>
                            <button class="btn btn-primary btn-add-to-cart">加入购物车</button>
                        </div>
                    </div>
                </div>
                <div class="product-detail">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab">商品详情</a></li>
                        <li role="presentation"><a href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab">用户评价</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
                            <?php echo $product->description; ?>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptAfterJs'); ?>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip({trigger:'hover'});
        $('.sku-btn').click(function () {
            $('.product-info .price span').text($(this).data('price'));
            $('.product-info .stock').text('库存：' + $(this).data('stock') + '件');
        });
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>