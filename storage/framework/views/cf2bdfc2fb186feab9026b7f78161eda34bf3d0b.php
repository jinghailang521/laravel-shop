<?php $__env->startSection('title','订单列表'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">订单列表</div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    订单号：<?php echo e($order->no); ?>

                                    <span class="pull-right"><?php echo e($order->created_at->format('Y-m-d H:i:s')); ?></span>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>商品信息</th>
                                                <th class="text-center">单价</th>
                                                <th class="text-center">数量</th>
                                                <th class="text-center">订单总价</th>
                                                <th class="text-center">状态</th>
                                                <th class="text-center">操作</th>
                                            </tr>
                                        </thead>
                                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="product-info">
                                                    <div class="preview">
                                                        <a target="_blank" href="<?php echo e(route('products.show',[$item->product_id])); ?>">
                                                            <img src="<?php echo e($item->product->image_url); ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <span class="product-title">
                                                            <a href="<?php echo e(route('products.show',[$item->product_id])); ?>"><?php echo e($item->product->title); ?></a>
                                                        </span>
                                                        <span class="sku-title"><?php echo e($item->productSku->title); ?></span>
                                                    </div>
                                                </td>
                                                <td class="sku-price text-center">￥<?php echo e($item->price); ?></td>
                                                <td class="sku-amount text-center"><?php echo e($item->amount); ?></td>
                                                <?php if( $index === 0 ): ?>
                                                    <td rowspan="<?php echo e(count($order->items)); ?>" class="text-center total-amount">￥<?php echo e($order->total_amount); ?></td>
                                                    <td rowspan="<?php echo e(count($order->items)); ?>" class="text-center">
                                                    <?php if( $order->paid_at ): ?>
                                                        <?php if( $order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING ): ?>
                                                            已支付
                                                        <?php else: ?>
                                                            <?php echo e(\App\Models\Order::$refundStatusMap[$order->refund_status]); ?>

                                                        <?php endif; ?>
                                                    <?php elseif( $order->closed ): ?>
                                                        已关闭
                                                    <?php else: ?>
                                                        未支付<br>
                                                        请于<?php echo e($order->created_at->addSeconds(config('app.order_ttl'))->format('H:i')); ?>

                                                        前完成支付<br>否则订单将自动关闭
                                                    <?php endif; ?>
                                                    </td>
                                                    <td rowspan="<?php echo e(count($order->items)); ?>" class="text-center"><a class="btn btn-primary btn-xs" href="">查看订单</a></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="pull-right"><?php echo e($orders->render()); ?></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>