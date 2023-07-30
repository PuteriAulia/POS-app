

<?php $__env->startSection('title','Pengaturan Akun | TokoKu'); ?>

<?php $__env->startSection('hero'); ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Pengaturan Akun
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Akun</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Ubah</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $account; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="content">
        <form action="/pengaturan-akun" method="POST">
            <?php echo csrf_field(); ?>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-options">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row justify-content-center py-sm-3 py-md-5">
                        <div class="col-sm-10 col-md-8">
                            <?php if(Session::has('status')=='failed'): ?>
                                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                    <?php echo e(Session::get('message')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <input type="hidden" class="form-control form-control-alt" id="id" name="id" value="<?php echo e($data->id); ?>">

                            <div class="form-group">
                                <label for="block-form1-name">Nama user</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" value="<?php echo e($data->name); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-email">Alamat email</label>
                                <input type="email" class="form-control form-control-alt" id="block-form1-email" name="email" value="<?php echo e($data->email); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-phone">Nomor telepon</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-phone" name="phone" value="<?php echo e($data->phone); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/setting/accountSetting.blade.php ENDPATH**/ ?>