<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    // DataTable Product
    $(function(){
        $('#product-table').DataTable({
            processing: true,
            serverSide: true,
			"bDestroy": true,
            ajax: "{{ url('barang') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'no', orderable:false, searchable:false },
                { data: 'product_code', name: 'code'},
                { data: 'name', name: 'name'},
                { data: 'purchase', name: 'purchase'},
                { data: 'sell', name: 'sell'},
                { data: 'suplier', name: 'suplier'},
                { data: 'product_stock', name: 'stock'},
                { data: 'action', name: 'action' },
            ]
        });
    })

    // Delete product
    $('body').on('click','#btn-del', function(){
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
                url : 'barang/'+id+'/hapus',
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