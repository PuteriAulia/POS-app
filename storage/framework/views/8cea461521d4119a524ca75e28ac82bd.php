<script>
    // Global setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    // DataTable Suplier
    $(function(){
        $('#suplier-table').DataTable({
            processing: true,
            serverSide: true,
			"bDestroy": true,
            ajax: "<?php echo e(url('suplier')); ?>",
            columns: [
                { data: 'DT_RowIndex', name: 'no', orderable:false, searchable:false },
                { data: 'suplier_code', name: 'code' },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'suplier_phone', name: 'phone' },
                { data: 'action', name: 'action' },
            ]
        });
    })

    // Store Suplier
    $('body').on('click','#modal-store-suplier',function(){
        $('#form-store-suplier').modal('show')
    })
    
    $('.store-suplier').click(function(e){
        e.preventDefault()
        $.ajax({
            url : '/suplier',
            type: 'POST',
            data: {
                name    : $('#nameStore').val(),
                address : $('#addressStore').val(),
                phone   : $('#phoneStore').val(),
            },
            success : function(res){
                if (res.errors) {
                    $.each(res.errors, function(prefix,value){
                        $('span.'+prefix+'_error').text(value[0])
                    })

                    $('.btn-cls-modal').click(function(){
                        $('span.name_error').text('')
                        $('span.address_error').text('')
                        $('span.phone_error').text('')
                    })
                } else {
                    Swal.fire(
                        'Berhasil',
                        `${res.message}`,
                        'success'
                    )

                    $('#nameStore').val('')
                    $('#addressStore').val('')
                    $('#phoneStore').val('')

                    $('span.name_error').text('')
                    $('span.address_error').text('')
                    $('span.phone_error').text('')

                    $('#form-store-suplier').modal('hide')
                }
                $('.dataTable').DataTable().ajax.reload()
            }
        })
    })

    // Edit Suplier
    $('body').on('click','#modal-edit-suplier',function(){
        let id = $(this).data('id')
        $.ajax({
            url : '/suplier/'+id+'/edit',
            type: 'GET',
            success: function(res){
                $('#idEdit').val(id)
                $('#nameEdit').val(res.data[0].suplier_name)
                $('#addressEdit').val(res.data[0].suplier_address)
                $('#phoneEdit').val(res.data[0].suplier_phone)
                $('#form-edit-suplier').modal('show')
            }
        })
    })

    $('.update-suplier').click(function(e){
        let id      = $('#idEdit').val()
        let name    = $('#nameEdit').val()
        let address = $('#addressEdit').val()
        let phone   = $('#phoneEdit').val()

        $.ajax({
            url : 'suplier/'+id,
            type: 'PUT',
            data: {
                'name'    : name,
                'address' : address,
                'phone'   : phone,
            },
            success: function(res){
                if (res.errors) {
                    $.each(res.errors, function(prefix,value){
                        $('span.'+prefix+'_error').text(value[0])
                    })

                    $('.btn-cls-modal').click(function(){
                        $('span.name_error').text('')
                        $('span.address_error').text('')
                        $('span.phone_error').text('')
                    })
                } else {
                    Swal.fire(
                        'Berhasil',
                        `${res.message}`,
                        'success'
                    )

                    $('span.name_error').text('')
                    $('span.address_error').text('')
                    $('span.phone_error').text('')

                    $('#form-edit-suplier').modal('hide')
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
                url : 'suplier/'+id+'/hapus',
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
</script><?php /**PATH D:\XAMPP\htdocs\project\laravel\projects\kasir-app\resources\views/supliers/scriptSuplier.blade.php ENDPATH**/ ?>