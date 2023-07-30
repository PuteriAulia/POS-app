@extends('layouts.mainLayouts')

@section('title','Transaksi | TokoKu')

@push('css')
<link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
@endpush

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Data Transaksi
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Transaksi</li>
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
        <div class="block-content">
            <div class="table-responsive">
                <table id="transaction-table" class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">No</th>
                            <th class="text-center" style="width: 10%;">Kode</th>
                            <th class="text-center" style="width: 20%;">Tanggal</th>
                            <th class="text-center" style="width: 20%;">Total</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
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
    // DataTable Suplier
    $(function(){
        $('#transaction-table').DataTable({
            processing: true,
            serverSide: true,
			"bDestroy": true,
            ajax: "{{ url('transaksi') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'no', orderable:false, searchable:false },
                { data: 'transaction_code', name: 'code' },
                { data: 'date', name: 'date' },
                { data: 'total', name: 'total' },
                { data: 'action', name: 'action' },
            ]
        });
    })

    // Show data transaction
    // $('body').on('click','#modal-detail-transaction', function(){
    //     let id = $(this).data('id')
    //     $.ajax({
    //         url : 'transaksi/'+id,
    //         type: 'GET',
    //         success : function(res){
    //             $('#username-transaksi').text('username | '+res.transaction[0].transaction_code)
    //             $('#grandTotal').text('Rp '+res.transaction[0].transaction_grand_total)
    //             $('#grandTotal-down').text('Rp '+res.transaction[0].transaction_grand_total)
    //             $('#disc').text('Rp '+res.transaction[0].transaction_disc)
    //             $('#total').text('Rp '+res.transaction[0].transaction_total)
    //             console.log(res.detail[0])
    //         }
    //     })
    //     $('#detail-transaction').modal('show');
    // })
</script>
@endpush