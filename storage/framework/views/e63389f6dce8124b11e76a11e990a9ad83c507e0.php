<?php $__env->startSection('title','收货地址列表'); ?>
<?php $__env->startSection('content'); ?>
<a href="http://www.oss.com/index.php?p=link&sp=2&ssp=cn">show.baidu.com</a><br/>
<a href="http://www.oss.com/index.php?p=link&sp=3&ssp=en">show.tengxun.com</a><br/>
<a href="http://www.oss.com/index.php?p=link&sp=4&ssp=en">show.360phone.com</a><br/>
<a href="http://www.oss.com/index.php?p=link&sp=5&ssp=en">show.alibaba.com</a><br/>
<a href="http://www.oss.com/index.php?p=link&sp=6&ssp=en">show.jingdong.com</a><br/>
<a href="http://www.oss.com/index.php?p=link&sp=7&ssp=en">show.xiaomi.com</a>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                收货地址列表
                <a href="<?php echo e(route('user_addresses.create')); ?>" class="pull-right">新增收货地址</a>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>收货人</th>
                        <th>地址</th>
                        <th>邮编</th>
                        <th>电话</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($address->contact_name); ?></td>
                        <td><?php echo e($address->full_address); ?></td>
                        <td><?php echo e($address->zip); ?></td>
                        <td><?php echo e($address->contact_phone); ?></td>
                        <td>
                            <a href="<?php echo e(route('user_addresses.edit',['user_address'=>$address->id])); ?>" class="btn btn-primary">修改</a>
                            <form action="<?php echo e(route('user_addresses.destroy', ['user_address' => $address->id])); ?>" method="post" style="display: inline-block">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('DELETE')); ?>

                                <button class="btn btn-danger btn-del-address" type="button" data-id="<?php echo e($address->id); ?>">删除</button>
                            </form>
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
        //
        $('.btn-del-address').click(function(){
            var id = $(this).data('id');
            //调用弹框
            swal({
                title : '确认要删除该地址吗',
                icon  : 'warning',
                buttons : ['取消','确认'],
                dangerMode : true
            })
            .then(function (willDelete) {//用户点击按钮后会触发这个回调函数
                //用户点击确认 willDelete:true else false
                if(!willDelete){
                    return ;
                }
                axios.delete('/user_addresses/' + id)
                    .then(function () {
                        //请求成功之后重新加载页面
                        location.reload();
                    })
                
            })
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>