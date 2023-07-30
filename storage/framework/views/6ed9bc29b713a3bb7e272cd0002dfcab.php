

<?php $__env->startSection('title','Pembayaran | TokoKu'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-7 col-xl-7 mt-3">
        <div class="block block-rounded block-themed">
            <div class="block-header bg-modern">
                <h3 class="block-title">PEMBAYARAN</h3>
            </div>
            <div class="block-content">
                <p class="text-muted"><?php echo e($inv); ?></p>
                <h3>TOTAL : <?php echo e(rupiahFormat($total)); ?></h3>
                <hr>

                <p class="text-muted">Detail Pembelian</p>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-muted">Nama barang</th>
                            <th class="text-muted">Qty</th>
                            <th class="text-muted">Sub total</th>
                        </tr>
                        <?php 
                            $date = date("Y-m-d");
                            foreach($cartItems as $data) : 
                        ?>
                        <tr>
                            <td class="text-muted" style="width: 70%;"><?php echo e($data->products->product_name); ?></td>
                            <td class="text-muted" style="width: 10%;"><?php echo e($data->product_qty); ?></td>
                            <td class="text-muted text-right" style="width: 20%;"><?php echo e(rupiahFormat($data->product_subtotal)); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <hr>
                <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;"><h4 class="text-muted">Total transaksi</h4></td>
                        <td class="text-muted text-right" style="width: 20%;"><?php echo e(rupiahFormat($total)); ?></td>
                    </tr>
                </table>

                <hr>
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;" class="text-muted">Diskon</td>
                        <td class="text-muted text-right" style="width: 20%;"><?php echo e(rupiahFormat($disc)); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 80%;" class="text-muted">Bayar</td>
                        <td class="text-muted text-right" style="width: 20%;"><?php echo e(rupiahFormat($payment)); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 80%;" class="text-muted"><b>Grand total</b></td>
                        <td class="text-muted text-right" style="width: 20%;"><b><?php echo e(rupiahFormat($grandTotal)); ?></b></td>
                    </tr>
                    <td style="width: 80%;" class="text-muted">Kembalian</td>
                        <td class="text-muted text-right" style="width: 20%;"><?php echo e(rupiahFormat($change)); ?></td>
                    </tr>
                </table>
                
                <?php $date = date("Y-m-d"); ?>
                <form action="/kasir/simpan-pembayaran" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="inv" name="inv" value="<?php echo e($inv); ?>">
                    <input type="hidden" id="total" name="total" value="<?php echo e($total); ?>">
                    <input type="hidden" id="grandTotal" name="grandTotal" value="<?php echo e($grandTotal); ?>">
                    <input type="hidden" id="disc" name="disc" value="<?php echo e($disc); ?>">
                    <input type="hidden" id="date" name="date" value="<?php echo e($date); ?>">

                    <button type="submit" id="saveTransaction" class="btn btn-success mb-4">
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/cashier/payment.blade.php ENDPATH**/ ?>