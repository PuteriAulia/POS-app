

<?php $__env->startSection('title','Tambah Barang Keluar | TokoKu'); ?>

<?php $__env->startSection('hero'); ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Tambah Barang Keluar
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Barang Keluar</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="/barang-keluar">Data</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Tambah</a>
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
        <div class="block-header block-header-default block-header-rtl">
            <h3 class="block-title"></h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-primary" id="store-product">
                    Tambah
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control form-control-alt" id="dateStore" name="date" placeholder="Masukkan tanggal..">
                        <span class="text-danger error_text date_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="product">Barang</label>
                        <div class="input-group">
                            <input type="text"  id="productStore" name="product" hidden>
                            <input type="text" class="form-control form-control-alt" id="productCode" placeholder="Masukkan barang..">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="modal-find-product">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <span class="text-danger error_text product_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="qty" class="form-control form-control-alt" id="qtyStore" name="qty" placeholder="Masukkan qty..">
                        <span class="text-danger error_text qty_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Keterangan</label>
                        <textarea class="form-control form-control-alt" id="descStore" name="desc" rows="5" placeholder="Masukkan keterangan.."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="form-find-product" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Pencarian Produk</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content font-size-sm">
                <!-- Start table -->
                <div class="table-responsive">
                    <table class="table-vcenter table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%;">No</th>
                                <th class="text-center" style="width: 20%;">Kode</th>
                                <th class="text-center" style="width: 20%;">Nama</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo e($no=1); ?>

                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo e($no++); ?></th>
                                <td><p><?php echo e($product->product_code); ?></p></td>
                                <td><p><?php echo e($product->product_name); ?></p></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm" id="chooseProduct" data-productid="<?php echo e($product->id); ?>" data-productcode="<?php echo e($product->product_code); ?>">Pilih</button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- End tabel -->
            </div>
            <div class="block-content block-content-full text-right border-top">
                <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        // Show modal product
        $('body').on('click','#modal-find-product',function(){
            $('#form-find-product').modal('show')
        })

        // Process product data
        $('body').on('click','#chooseProduct',function(){
            var productId = $(this).data('productid')
            var productCode = $(this).data('productcode')

            $('#productCode').val(productCode)
            $('#productStore').val(productId)
            $('#form-find-product').modal('hide')
        })

        //Store product
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        })

        $('#store-product').click(function(e){
            e.preventDefault()
            $.ajax({
                url : '/barang-keluar',
                type: 'POST',
                data: {
                    product : $('#productStore').val(),
                    date    : $('#dateStore').val(),
                    qty     : $('#qtyStore').val(),
                    desc    : $('#descStore').val(),
                },
                success: function(res){
                    if (res.errors) {
                        $.each(res.errors, function(prefix,value){
                            $('span.'+prefix+'_error').text(value[0])
                        })

                        $('.btn-cls-modal').click(function(){
                            $('span.product_error').text('')
                            $('span.date_error').text('')
                            $('span.qty_error').text('')
                            $('span.desc_error').text('')
                        })
                    } else {
                        Swal.fire(
                            'Berhasil',
                            `${res.message}`,
                            'success'
                        )
                        $('#productStore').val('')
                        $('#dateStore').val('')
                        $('#productCode').val('')
                        $('#qtyStore').val('')
                        $('#descStore').val('')

                        $('span.product_error').text('')
                        $('span.date_error').text('')
                        $('span.qty_error').text('')
                        $('span.desc_error').text('')
                    }
                }
            })
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.mainLayouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/productOut/formStoreProductOut.blade.php ENDPATH**/ ?>