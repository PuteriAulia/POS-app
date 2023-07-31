@extends('layouts.mainLayouts')

@section('title','Edit User | TokoKu')

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Ubah User
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="/user">Data</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Ubah</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default block-header-rtl">
            <h3 class="block-title"></h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-primary" id="update-user">
                    Ubah
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                @foreach ($user as $data)
                <div class="col-sm-10 col-md-8">
                    <input type="text" id="idEdit" name="id" value="{{ $data->id }}" hidden>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-alt" id="nameEdit" name="name" value="{{ $data->name }}">
                        <span class="text-danger error_text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="suplier">Role</label>
                        <div class="input-group">
                            <input type="text"  id="roleEdit" name="role" value="{{ $data->role_id }}" hidden>
                            <input type="text" class="form-control form-control-alt" id="roleCode" value="{{ $data->role->role_code }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="modal-find-role">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <span class="text-danger error_text role_error"></span>
                        </div>
                        <span class="text-danger error_text role_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="text">Nomor telepon</label>
                        <input type="text" class="form-control form-control-alt" id="phoneEdit" name="phone" value="{{ $data->phone }}">
                        <span class="text-danger error_text phone_error"></span>
                    </div>
                </div>                    
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Modal find suplier --}}
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
                            {{ $no=1; }}
                            @foreach ($roles as $role)
                            <tr>
                                <th class="text-center" scope="row">{{ $no++; }}</th>
                                <td><p>{{ $role->role_code }}</p></td>
                                <td><p>{{ $role->role_name }}</p></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm" id="chooseRole" data-roleid="{{ $role->id }}" data-rolecode="{{ $role->role_code }}">Pilih</button>
                                </td>
                            </tr>
                            @endforeach
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
{{-- END Modal find suplier--}}
@endsection

@push('js')
<script>
    $('body').on('click','#modal-find-role', function(){
        $('#form-find-role').modal('show')
    })

    // Process role data
    $('body').on('click','#chooseRole',function(){
        var roleId = $(this).data('roleid')
        var roleCode = $(this).data('rolecode')

        $('#roleCode').val(roleCode)
        $('#roleEdit').val(roleId)
        $('#form-find-role').modal('hide')
    })

    //Store product
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    $('body').on('click','#update-user',function(e){
        let id = $('#idEdit').val()
        $.ajax({
            url:'/user/'+id,
            type: 'PUT',
            data: {
                name : $('#nameEdit').val(),
                role : $('#roleEdit').val(),
                phone: $('#phoneEdit').val(),
            },
            success: function(res){
                // console.log(res)
                if (res.errors) {
                    $.each(res.errors, function(prefix,value){
                        $('span.'+prefix+'_error').text(value[0])
                    })
                }else{
                    Swal.fire(
                        'Berhasil',
                        `${res.message}`,
                        'success'
                    )
                   
                    $('span.name_error').text('')
                    $('span.role_error').text('')
                    $('span.phone_error').text('')
                }
            }
        })
    })
</script>
@endpush