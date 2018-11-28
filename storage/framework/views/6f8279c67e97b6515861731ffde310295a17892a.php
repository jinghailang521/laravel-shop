<?php $__env->startSection('title', '查看订单'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>订单详情</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>商品信息</th>
                            <th class="text-center">单价</th>
                            <th class="text-center">数量</th>
                            <th class="text-right item-amount">小计</th>
                        </tr>
                        </thead>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="product-info">
                                    <div class="preview">
                                        <a target="_blank" href="<?php echo e(route('products.show', [$item->product_id])); ?>">
                                            <img src="<?php echo e($item->product->image_url); ?>">
                                        </a>
                                    </div>
                                    <div>
            <span class="product-title">
               <a target="_blank" href="<?php echo e(route('products.show', [$item->product_id])); ?>"><?php echo e($item->product->title); ?></a>
             </span>
                                        <span class="sku-title"><?php echo e($item->productSku->title); ?></span>
                                    </div>
                                </td>
                                <td class="sku-price text-center vertical-middle">￥<?php echo e($item->price); ?></td>
                                <td class="sku-amount text-center vertical-middle"><?php echo e($item->amount); ?></td>
                                <td class="item-amount text-right vertical-middle">￥<?php echo e(number_format($item->price * $item->amount, 2, '.', '')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr><td colspan="4"></td></tr>
                    </table>
                    <div class="order-bottom">
                        <div class="order-info">
                            <div class="line"><div class="line-label">收货地址：</div><div class="line-value"><?php echo e(join(' ', $order->address)); ?></div></div>
                            <div class="line"><div class="line-label">订单备注：</div><div class="line-value"><?php echo e($order->remark ?: '-'); ?></div></div>
                            <div class="line"><div class="line-label">订单编号：</div><div class="line-value"><?php echo e($order->no); ?></div></div>
                        </div>
                        <div class="order-summary text-right">
                            <div class="total-amount">
                                <span>订单总价：</span>
                                <div class="value">￥<?php echo e($order->total_amount); ?></div>
                            </div>
                            <div>
                                <span>订单状态：</span>
                                <div class="value">
                                    <?php if($order->paid_at): ?>
                                        <?php if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING): ?>
                                            已支付
                                        <?php else: ?>
                                            <?php echo e(\App\Models\Order::$refundStatusMap[$order->refund_status]); ?>

                                        <?php endif; ?>
                                    <?php elseif($order->closed): ?>
                                        已关闭
                                    <?php else: ?>
                                        未支付
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>