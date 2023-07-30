@extends('layouts.mainLayouts')

@section('title','Edit Barang | TokoKu')

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Ubah Barang
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Barang</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="/barang">Data</a>
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
                <button type="button" class="btn btn-sm btn-primary" id="update-product">
                    Ubah
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                @foreach ($products as $data)
                <div class="col-sm-10 col-md-8">
                    <input type="text" id="idEdit" name="id" value="{{ $data->id }}" hidden>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-alt" id="nameEdit" name="name" value="{{ $data->product_name }}">
                        <span class="text-danger error_text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="suplier">Suplier</label>
                        <div class="input-group">
                            <input type="text"  id="suplierEdit" name="suplier" value="{{ $data->suplier_id }}" hidden>
                            <input type="text" class="form-control form-control-alt" id="suplierCode" value="{{ $data->supliers->suplier_code }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="modal-find-suplier">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <span class="text-danger error_text suplier_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="purchase">Harga beli</label>
                                <input type="number" class="form-control form-control-alt" id="purchaseEdit" name="purchase" value="{{ $data->product_purchase }}">
                                <span class="text-danger error_text purchase_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sell">Harga jual</label>
                                <input type="text" class="form-control form-control-alt" id="sellEdit" name="sell" value="{{ $data->product_sell }}">
                                <span class="text-danger error_text sell_error"></span>
                            </div>
                        </div>
                    </div>
                </div>                    
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Modal find suplier --}}
<div class="modal" id="form-find-suplier" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Pencarian Suplier</h3>
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
                            @foreach ($supliers as $suplier)
                            <tr>
                                <th class="text-center" scope="row">{{ $no++; }}</th>
                                <td><p>{{ $suplier->suplier_code }}</p></td>
                                <td><p>{{ $suplier->suplier_name }}</p></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm" id="chooseSuplier" data-suplierid="{{ $suplier->id }}" data-supliercode="{{ $suplier->suplier_code }}">Pilih</button>
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
    $('body').on('click','#modal-find-suplier', function(){
        $('#form-find-suplier').modal('show')
    })

    //Process suplier data
    $('body').on('click','#chooseSuplier',function(){
        var suplierId = $(this).data('suplierid')
        var suplierCode = $(this).data('supliercode')

        $('#suplierCode').val(suplierCode)
        $('#suplierStore').val(suplierId)
        $('#form-find-suplier').modal('hide')
    })

    // Edit product
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    $('#update-product').click(function(){
        let id      = $('#idEdit').val()
        let name    = $('#nameEdit').val()
        let suplier = $('#suplierEdit').val()
        let purchase= $('#purchaseEdit').val()
        let sell    = $('#sellEdit').val()


        $.ajax({
            url : '/barang/'+id,
            type: 'PUT',
            data: {
                'name'    : name,
                'suplier' : suplier,
                'purchase': purchase,
                'sell'    : sell,
            },
            success: function(res){
                if (res.errors) {
                    $.each(res.errors, function(prefix,value){
                        $('span.'+prefix+'_error').text(value[0])
                    })

                    $('.btn-cls-modal').click(function(){
                        $('span.name_error').text('')
                        $('span.suplier_error').text('')
                        $('span.purchase_error').text('')
                        $('span.sell_error').text('')
                    })
                } else {
                    Swal.fire(
                        'Berhasil',
                        `${res.message}`,
                        'success'
                    )
                   
                    $('span.name_error').text('')
                    $('span.suplier_error').text('')
                    $('span.purchase_error').text('')
                    $('span.sell_error').text('')
                }
                $('.dataTable').DataTable().ajax.reload()
            }
        })
    })
</script>
@endpush