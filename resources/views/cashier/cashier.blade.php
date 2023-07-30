@extends('layouts.mainLayouts')

@section('title','Kasir | TokoKu')

@section('hero')
<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
            Kasir
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">Transaksi</li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">Kasir</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="content">
    @if (Session::has('status')=='failed')
    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <!-- Choose Product -->
            <div class="block block-rounded">
                <div class="block-content p-3">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">ID Transaksi</div>
                    <div class="font-size-h2 text-dark" id="invoice">{{ $inv }}</div>
                </div>
            </div>
            <!-- End choose product -->
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <!-- Total payment -->
            <div class="block block-rounded">
                <div class="block-content p-3">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Total</div>
                    <div class="font-size-h2 font-w400 text-dark" id="startTotal">{{ rupiahFormat($total) }}</div>
                    <div class="font-size-h2 font-w400 text-dark" id="nextTotal"></div>
                </div>
            </div>
            <!-- End total payment -->
        </div>
    
        <div class="col-lg-2 col-md-2 col-sm-2">
            <!-- Tombol payment -->
            <div class="block block-rounded">
                <div class="block-content p-3">
                    <div class="font-size-sm font-w600 text-uppercase text-muted mb-2">Pembayaran</div>
                    <button type="submit" class="btn btn-success" id="formPayment" data-toggle="modal">
                        Bayar
                    </button>
                </div>
            </div>
            <!-- End Tombol payment -->
        </div>
    </div>
    
    <!-- Start add product & qty -->
    <div class="block block-rounded">
        <div class="block-content">
            <h5>Pilih barang</h5>
            <!-- Start choose product -->
            <div class="form-group">
                <form action="/kasir" method="POST">
                    <div class="row">
                        @csrf
                        <input type="hidden" class="form-control form-control-alt" name="inv" value="{{ $inv }}">
                        <div class="col-7 col-md-7 col-lg-7 col-xl-7">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-alt" id="productAdd" placeholder="Masukkan nama barang.." name="productCode" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-find-product">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                            <input type="number" class="form-control form-control-alt" id="qtyAdd" name="qty" placeholder="Jumlah barang.." required>
                        </div>
        
                        <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                            <button type="submit" class="btn btn-primary" id="add_product_list">
                                Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End form choose product -->
        </div>
    </div>
    <!-- End add product & qty -->

    <!-- Product List -->
    <div class="block block-rounded">
        <div class="block-content">
            <div class="table-responsive">
                <table id="selectedProduct-table" class="table table-striped table-vcenter">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" style="width: 10%;">No</th>
                            <th class="text-center" style="width: 20%;">Nama</th>
                            <th class="text-center" style="width: 10%;">Jumlah</th>
                            <th class="text-center" style="width: 10%;">Harga</th>
                            <th class="text-center" style="width: 10%;">Sub total</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- End daftar barang -->
    </div>
@include('cashier.formAddProduct')
@include('cashier.formPayment')
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

<script>
    // DataTable ProductIn
    $(function(){
        $('#selectedProduct-table').DataTable({
            processing: true,
            serverSide: true,
			"bDestroy": true,
            ajax: "{{ url('kasir') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'no', orderable:false, searchable:false },
                { data: 'name', name: 'name' },
                { data: 'qty', name: 'qty' },
                { data: 'sell', name: 'sell' },
                { data: 'subtotal', name: 'subtotal' },
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

    // Add product
    $('body').on('click','#chooseProduct',function(){
        var product = $(this).data('product')
        $('#productAdd').val(product)
        $('#form-find-product').modal('hide')
    })

    // Delete cart
    $('body').on('click','#button-delete-cart',function(){ 
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
                url : 'kasir/hapus-keranjang/'+id,
                type: 'GET',
                success: function(res){
                    location.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            })
        }})
    })

    // Show form payment
    $('body').on('click', '#formPayment', function(){
        $('#process-payment').modal('show')
    }) 
</script>
@endpush