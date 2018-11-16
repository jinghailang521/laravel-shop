<?php $__env->startSection('title', '购物车'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">我的购物车</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>商品信息</th>
                            <th>单价</th>
                            <th>数量</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody class="product_list">
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-id="<?php echo e($item->id); ?>">
                                <td>
                                    <input type="checkbox" name="select" value="<?php echo e($item->productSku->id); ?>" <?php echo e($item->productSku->product->on_sale ? 'checked' : 'disabled'); ?>>
                                </td>
                                <td class="product_info">
                                    <div class="preview">
                                        <a target="_blank" href="<?php echo e(route('products.show', [$item->productSku->product_id])); ?>">
                                            <img src="<?php echo e($item->productSku->product->image_url); ?>">
                                        </a>
                                    </div>
                                    <div <?php if(!$item->productSku->product->on_sale): ?> class="not_on_sale" <?php endif; ?>>
                                          <span class="product_title">
                                            <a target="_blank" href="<?php echo e(route('products.show', [$item->productSku->product_id])); ?>"><?php echo e($item->productSku->product->title); ?></a>
                                          </span>
                                          <span class="sku_title"><?php echo e($item->productSku->title); ?></span>
                                            <?php if(!$item->productSku->product->on_sale): ?>
                                                <span class="warning">该商品已下架</span>
                                            <?php endif; ?>
                                    </div>
                                </td>
                                <td><span class="price">￥<?php echo e($item->productSku->price); ?></span></td>
                                <td>
                                    <input type="text" class="form-control input-sm amount" <?php if(!$item->productSku->product->on_sale): ?> disabled <?php endif; ?> name="amount" value="<?php echo e($item->amount); ?>">
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-danger btn-remove">移除</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptAfterJs'); ?>
<script>
    $(document).ready(function () {

        $('.btn-remove').click(function () {
            //监听 移除 按钮的jQuery对象
            var id = $(this).closest('tr').data('id');
            swal({
                title       : '确认将该商品移除',
                icon        : 'warning',
                buttons     : ['取消','确定'],
                dangerMode  : true,
            })
                .then(function (willDelete) {
                    //用户点击 确认按钮，willDelete的值就会是true 否则为 false
                    if( !willDelete ){
                        return;
                    }
                    axios.delete('/cart/' + id)
                        .then(function () {
                            location.reload();
                        })
                })
        });
        //全选反选
        $('#select-all').change(function () {
            var checked = $(this).prop('checked');
            $('input[name=select][type=checkbox]:not([disabled])').each(function () {
                $(this).prop('checked',checked);
            })
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>