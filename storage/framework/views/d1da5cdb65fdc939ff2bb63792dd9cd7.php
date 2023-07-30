

<?php $__env->startSection('title','User | TokoKu'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('hero'); ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Data User
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">User</li>
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
            <a href="/user/create"><button id="modal-store-user" class="btn btn-alt-primary">Tambah user</button></a>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table id="user-table" class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">No</th>
                            <th class="text-center" style="width: 20%;">Nama</th>
                            <th class="text-center" style="width: 15%;">Username</th>
                            <th class="text-center" style="width: 15%;">Email</th>
                            <th class="text-center" style="width: 15%;">Role</th>
                            <th class="text-center" style="width: 20%;">Nomor telepon</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
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
    // DataTable Suplier
    $(function(){
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
			"bDestroy": true,
            ajax: "<?php echo e(url('user')); ?>",
            columns: [
                { data: 'DT_RowIndex', no: 'no', orderable:false, searchable:false },
                { data: 'name', name: 'name' },
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'phone', name: 'phone' },
                { data: 'action', name: 'action' },
            ]
        });
    })

    //Store product
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    // Delete user
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
                url : '/user/'+id+'/hapus',
                type: 'PUT',
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

    // Edit user
    
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.mainLayouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/user/dataUser.blade.php ENDPATH**/ ?>