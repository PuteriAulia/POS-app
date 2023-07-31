@extends('layouts.mainLayouts')

@section('title','Role | TokoKu')

@push('css')
<link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
@endpush

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Data Role
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Role</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Data</a>
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
        <div class="block-header">
           <button class="btn btn-alt-primary" id="modal-store-role">Tambah role</button>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table id="role-table" class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">No</th>
                            <th class="text-center" style="width: 30%;">Kode</th>
                            <th class="text-center" style="width: 30%;">Nama</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@include('role.formStoreRole')
@include('role.formEditRole')
@endsection

@push('js')
<script src={{ asset("assets/js/plugins/datatables/jquery.dataTables.min.js") }}></script>
<script src={{ asset("assets/js/plugins/datatables/dataTables.bootstrap4.min.js") }}></script>
<script src={{ asset("assets/js/plugins/datatables/buttons/dataTables.buttons.min.js") }}></script>
<script src={{ asset("assets/js/plugins/datatables/buttons/buttons.print.min.js") }}></script>
<script src={{ asset("assets/js/plugins/datatables/buttons/buttons.html5.min.js") }}></script>
<script src={{ asset("assets/js/plugins/datatables/buttons/buttons.flash.min.js") }}></script>
<script src={{ asset("assets/js/plugins/datatables/buttons/buttons.colVis.min.js") }}></script>

<!-- Page JS Code -->
<script src="assets/js/pages/be_tables_datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // DataTable Product
    $(function(){
        $('#role-table').DataTable({
            processing: true,
            serverSide: true,
			"bDestroy": true,
            ajax: "{{ url('role') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'no', orderable:false, searchable:false },
                { data: 'role_code', name: 'code'},
                { data: 'name', name: 'name'},
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

    // Store role
    $('body').on('click','#modal-store-role',function(){
        $('#form-store-role').modal('show')
    })

    $('body').on('click','.store-role',function(){
        $.ajax({
            url : 'role',
            type: 'POST',
            data: {
                role_name : $('#nameStore').val(),
            },
            success : function(res){
                if (res.errors) {
                    $.each(res.errors, function(prefix,value){
                        $('span.'+prefix+'_error').text(value[0])
                    })

                    $('.btn-cls-modal').click(function(){
                        $('span.name_error').text('')
                    })
                } else {
                    Swal.fire(
                        'Berhasil',
                        `${res.message}`,
                        'success'
                    )

                    $('#nameStore').val('')

                    $('span.name_error').text('')

                    $('#form-store-role').modal('hide')
                }
                $('.dataTable').DataTable().ajax.reload()
            }
        })
    })

    // Edit role
    $('body').on('click','#modal-edit-role',function(){
        let id = $(this).data('id')

        $.ajax({
            url : '/role/'+id+'/edit',
            type: 'GET',
            success: function(res){
                $('#idEdit').val(id)
                $('#nameEdit').val(res.data[0].role_name)
                $('#form-edit-role').modal('show')
            }
        })
    })

    $('.update-role').click(function(e){
        let id   = $('#idEdit').val()
        let name = $('#nameEdit').val()

        $.ajax({
            url : '/role/'+id,
            type: 'PUT',
            data: {
                'name' : name,
            },
            success: function(res){
                if (res.errors) {
                    $.each(res.errors, function(prefix,value){
                        $('span.'+prefix+'_error').text(value[0])
                    })

                    $('.btn-cls-modal').click(function(){
                        $('span.name_error').text('')
                    })
                } else {
                    Swal.fire(
                        'Berhasil',
                        `${res.message}`,
                        'success'
                    )

                    $('span.name_error').text('')

                    $('#form-edit-role').modal('hide')
                }
                $('.dataTable').DataTable().ajax.reload()
            }
        })
    })

    // Delete suplier
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
                url : 'role/'+id+'/hapus',
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
</script>
@endpush