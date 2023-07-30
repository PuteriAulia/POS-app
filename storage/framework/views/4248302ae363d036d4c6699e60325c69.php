

<?php $__env->startSection('title','Barang Keluar | TokoKu'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('hero'); ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Data Barang Keluar
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Barang keluar</li>
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
            <a href="/barang-keluar/create"><button class="btn btn-alt-primary">Tambah barang keluar</button></a>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table id="productOut-table" class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">No</th>
                            <th class="text-center" style="width: 15%;">Kode</th>
                            <th class="text-center" style="width: 20%;">Nama</th>
                            <th class="text-center" style="width: 20%;">Tanggal</th>
                            <th class="text-center" style="width: 10%;">Qty</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('productOut.detailProductOut', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
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

<script>
    // DataTable ProductIn
    $(function(){
        $('#productOut-table').DataTable({
            processing: true,
            serverSide: true,
			"bDestroy": true,
            ajax: "<?php echo e(url('barang-keluar')); ?>",
            columns: [
                { data: 'DT_RowIndex', name: 'no', orderable:false, searchable:false },
                { data: 'productOut_code', name: 'code' },
                { data: 'name', name: 'name' },
                { data: 'date', name: 'date' },
                { data: 'productOut_qty', name: 'qty' },
                { data: 'action', name: 'action' },
            ]
        });
    })

    // Global setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    // Delete product
    $('body').on('click','#btn-del',function(){
        Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang sudah dihapus tidak dapat dilihat kembali",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
        }).then((result) => {
        if (result.isConfirmed) {
            let id = $(this).data('id')
            $.ajax({
                url : 'barang-keluar/'+id,
                type: 'DELETE',
                success: function(res){
                    Swal.fire(
                        'Berhasil',
                        `${res.message}`,
                        'success'
                    )
                    $('.dataTable').DataTable().ajax.reload();
                }
            })
        }})
    })

    // Detail product
    $('body').on('click','#modal-detail-productOut',function(){
        let id = $(this).data('id')
        $.ajax({
            url: "barang-keluar/"+id,
            type: "GET",
            success: function(res){
                let month = res.productOut[0].productOut_date.substr(5,2)
                let year  = res.productOut[0].productOut_date.substr(0,4)
                let date  = res.productOut[0].productOut_date.substr(8,2)
                let monthString = ''

                if (month == 01) {
                    monthString = 'Januari'
                }else if(month == 02){
                    monthString = 'Februari'
                }else if(month == 03){
                    monthString = 'Maret'
                }else if(month == 04){
                    monthString = 'April'
                }else if(month == 05){
                    monthString = 'Mei'
                }else if(month ===06){
                    monthString = 'Juni'
                }else if(month == 07){
                    monthString = 'Juli'
                }else if(month == 08){
                    monthString = 'Agustus'
                }else if(month == 09){
                    monthString = 'September'
                }else if(month == 10){
                    monthString = 'Oktober'
                }else if(month == 11){
                    monthString = 'November'
                }else if(month == 12){
                    monthString = 'Desember'
                }

                $('#productDetail').text(res.productName)
                $('#dateDetail').text(": "+date+' '+monthString+' '+year)
                $('#qtyDetail').text(": "+res.productOut[0].productOut_qty)
                $('#descDetail').text(": "+res.productOut[0].productOut_info)
                $('#detail-productOut').modal('show')
            }
        })
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.mainLayouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/productOut/dataProductOut.blade.php ENDPATH**/ ?>