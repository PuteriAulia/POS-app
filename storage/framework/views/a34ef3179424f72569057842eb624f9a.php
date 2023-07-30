<div class="modal fade" id="form-find-product" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Pencarian Barang</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content font-size-sm">
                <!-- Start table -->
                <div class="table-responsive">
                    <table class="table table-vcenter table table-bordered js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%;">No</th>
                                <th class="text-center" style="width: 20%;">Kode</th>
                                <th class="text-center" style="width: 20%;">Nama</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo e($no++); ?></th>
                                <td><p><?php echo e($product->product_code); ?></p></td>
                                <td><p><?php echo e($product->product_name); ?></p></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm" id="chooseProduct" data-product="<?php echo e($product->product_code); ?>">Pilih</button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- End tabel -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- End modal pilih barang--><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/cashier/formAddProduct.blade.php ENDPATH**/ ?>