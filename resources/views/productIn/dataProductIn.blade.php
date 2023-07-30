@extends('layouts.mainLayouts')

@section('title','Barang Masuk | TokoKu')

@push('css')
<link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
@endpush

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Data Barang Masuk
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Barang masuk</li>
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
            <a href="/barang-masuk/create"><button class="btn btn-alt-primary">Tambah barang masuk</button></a>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table id="productIn-table" class="table table-striped table-vcenter">
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

@include('productIn.detailProductIn');
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
    // DataTable ProductIn
    $(function(){
        $('#productIn-table').DataTable({
            processing: true,
            serverSide: true,
			"bDestroy": true,
            ajax: "{{ url('barang-masuk') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'no', orderable:false, searchable:false },
                { data: 'productIn_code', name: 'code' },
                { data: 'name', name: 'name' },
                { data: 'date', name: 'date' },
                { data: 'productIn_qty', name: 'qty' },
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
                url : 'barang-masuk/'+id,
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
    $('body').on('click','#modal-detail-productIn',function(){
        let id = $(this).data('id')
        $.ajax({
            url: "barang-masuk/"+id,
            type: "GET",
            success: function(res){
                let month = res.productIn[0].productIn_date.substr(5,2)
                let year  = res.productIn[0].productIn_date.substr(0,4)
                let date  = res.productIn[0].productIn_date.substr(8,2)
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
                $('#qtyDetail').text(": "+res.productIn[0].productIn_qty)
                $('#descDetail').text(": "+res.productIn[0].productIn_info)
                $('#detail-productIn').modal('show')
            }
        })
    })
</script>
@endpush