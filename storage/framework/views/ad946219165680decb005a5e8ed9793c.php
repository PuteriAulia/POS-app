

<?php $__env->startSection('hero'); ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Tambah User
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="/user">Data</a>
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
                <button type="button" class="btn btn-sm btn-primary" id="store-user">
                    Tambah
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="alert alert-danger alert-dismissible fade show mt-4 d-none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-alt" id="nameStore" name="name" placeholder="Masukkan nama user..">
                        <span class="text-danger error_text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <div class="input-group">
                            <input type="text"  id="roleStore" name="role" hidden>

                            <input type="text" class="form-control form-control-alt" id="roleCode" placeholder="Masukkan role..">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="modal-find-role">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <span class="text-danger error_text role_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control form-control-alt" id="emailStore" name="email" placeholder="Masukkan email user..">
                        <span class="text-danger error_text email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor telepon</label>
                        <input type="text" class="form-control form-control-alt" id="phoneStore" name="phone" placeholder="Masukkan nomor telepon user..">
                        <span class="text-danger error_text phone_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-alt" id="usernameStore" name="username" placeholder="Masukkan username..">
                                <span class="text-danger error_text username_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control form-control-alt" id="passwordStore" name="password" placeholder="Masukkan password..">
                                <span class="text-danger error_text password_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="form-find-role" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Pencarian Role</h3>
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

                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo e($no++); ?></th>
                                <td><p><?php echo e($role->role_code); ?></p></td>
                                <td><p><?php echo e($role->role_name); ?></p></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm" id="chooseRole" data-roleid="<?php echo e($role->id); ?>" data-rolecode="<?php echo e($role->role_code); ?>">Pilih</button>
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
        // Show modal role
        $('body').on('click','#modal-find-role',function(){
            $('#form-find-role').modal('show')
        })

        // Process role data
        $('body').on('click','#chooseRole',function(){
            var roleId = $(this).data('roleid')
            var roleCode = $(this).data('rolecode')

            $('#roleCode').val(roleCode)
            $('#roleStore').val(roleId)
            $('#form-find-role').modal('hide')
        })

        //Store product
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        })

        // Store user
        $('body').on('click','#store-user',function(e){
            e.preventDefault()
            $.ajax({
                url:'/user',
                type: 'POST',
                data: {
                    name    : $('#nameStore').val(),
                    role    : $('#roleStore').val(),
                    email   : $('#emailStore').val(),
                    phone   : $('#phoneStore').val(),
                    username: $('#usernameStore').val(),
                    password: $('#passwordStore').val(),
                },
                success : function(res){
                    console.log(res)
                    if (res.errors) {
                        $.each(res.errors, function(prefix,value){
                            $('span.'+prefix+'_error').text(value[0])
                        })
                    }else{
                        if (res.status === 'failed email and username' || res.status === 'failed email' || res.status === 'failed username') {
                            $('.alert-danger').removeClass('d-none')
                            $('.alert-danger').append(res.message)
                        }else{
                            Swal.fire(
                                'Berhasil',
                                `${res.message}`,
                                'success'
                            )
                            $('#nameStore').val('')
                            $('#roleStore').val('')
                            $('#roleId').val('')
                            $('#emailCode').val('')
                            $('#phoneStore').val('')
                            $('#usernameStore').val('')
                            $('#passwordStore').val('')
                            $('#emailStore').val('')

                            $('span.name_error').text('')
                            $('span.role_error').text('')
                            $('span.email_error').text('')
                            $('span.phone_error').text('')
                            $('span.username_error').text('')
                            $('span.password_error').text('')
                        }
                    }
                }
            })
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.mainLayouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/user/formStoreUser.blade.php ENDPATH**/ ?>