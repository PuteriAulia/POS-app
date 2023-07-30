

<?php $__env->startSection('title','Suplier | TokoKu'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('hero'); ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Data Suplier
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Suplier</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Data</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="block block-rounded">
        <div class="block-header">
            <button id="modal-store-suplier" class="btn btn-alt-primary">Tambah suplier</button>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table id="suplier-table" class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">No</th>
                            <th class="text-center" style="width: 10%;">Kode</th>
                            <th class="text-center" style="width: 20%;">Nama</th>
                            <th class="text-center" style="width: 20%;">Alamat</th>
                            <th class="text-center" style="width: 15%;">Telepon</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('supliers.formStoreSuplier', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('supliers.formEditSuplier', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src=<?php echo e(asset("assets/js/plugins/datatables/jquery.dataTables.min.js")); ?>></script>
<script src=<?php echo e(asset("assets/js/plugins/datatables/dataTables.bootstrap4.min.js")); ?>></script>
<script src=<?php echo e(asset("assets/js/plugins/datatables/buttons/dataTables.buttons.min.js")); ?>></script>
<script src=<?php echo e(asset("assets/js/plugins/datatables/buttons/buttons.print.min.js")); ?>></script>
<script src=<?php echo e(asset("assets/js/plugins/datatables/buttons/buttons.html5.min.js")); ?>></script>
<script src=<?php echo e(asset("assets/js/plugins/datatables/buttons/buttons.flash.min.js")); ?>></script>
<script src=<?php echo e(asset("assets/js/plugins/datatables/buttons/buttons.colVis.min.js")); ?>></script>

<!-- Page JS Code -->
<script src="assets/js/pages/be_tables_datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php echo $__env->make('supliers.scriptSuplier', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.mainLayouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/supliers/dataSupliers.blade.php ENDPATH**/ ?>