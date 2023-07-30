

<?php $__env->startSection('title','Dashboard | TokoKu'); ?>

<?php $__env->startSection('hero'); ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Halaman Dashboard
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Selamat datang <?php echo e(ucwords(Auth::user()->name)); ?>, semoga harimu menyenangkan.
                </h2>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row row-deck">
        <!-- Income -->
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h3 font-w700">Rp<?php echo e(number_format($grandTotal)); ?></dt>
                        <dd class="text-muted mb-0">Total Pendapatan</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-money-bill font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="/transaksi">
                        Daftar transaksi
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Income -->

        <!-- Sell Amount -->
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700"><?php echo e($countTransaction); ?></dt>
                        <dd class="text-muted mb-0">Total Transaksi</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="/transaksi">
                        Daftar transaksi
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Sell Amount -->

        <!-- Product Amount -->
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700"><?php echo e($countProduct); ?></dt>
                        <dd class="text-muted mb-0">Jumlah Barang</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-briefcase font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="/barang">
                        Daftar barang
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Product Amount -->

        <!-- Suplier Amount -->
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700"><?php echo e($countSuplier); ?></dt>
                        <dd class="text-muted mb-0">Jumlah Suplier</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-user-alt font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="/suplier">
                        Daftar suplier
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Suplier Amount -->
    </div>

    <div class="row">
        <div class="col-xl-12 d-flex flex-column">
            <!-- Earnings Summary -->
            <div class="block block-rounded flex-grow-1 d-flex flex-column">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Penjualan Setiap Bulan</h3>
                </div>
                <div class="block-content">
                    <?php echo $chart->container(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e($chart->cdn()); ?>"></script>

<?php echo e($chart->script()); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.mainLayouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/dashboard.blade.php ENDPATH**/ ?>