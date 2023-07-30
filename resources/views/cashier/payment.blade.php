@extends('layouts.mainLayouts')

@section('title','Pembayaran | TokoKu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-xl-7 mt-3">
        <div class="block block-rounded block-themed">
            <div class="block-header bg-modern">
                <h3 class="block-title">PEMBAYARAN</h3>
            </div>
            <div class="block-content">
                <p class="text-muted">{{ $inv }}</p>
                <h3>TOTAL : {{ rupiahFormat($total) }}</h3>
                <hr>

                <p class="text-muted">Detail Pembelian</p>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-muted">Nama barang</th>
                            <th class="text-muted">Qty</th>
                            <th class="text-muted">Sub total</th>
                        </tr>
                        <?php 
                            $date = date("Y-m-d");
                            foreach($cartItems as $data) : 
                        ?>
                        <tr>
                            <td class="text-muted" style="width: 70%;">{{ $data->products->product_name }}</td>
                            <td class="text-muted" style="width: 10%;">{{ $data->product_qty }}</td>
                            <td class="text-muted text-right" style="width: 20%;">{{ rupiahFormat($data->product_subtotal) }}</td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <hr>
                <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;"><h4 class="text-muted">Total transaksi</h4></td>
                        <td class="text-muted text-right" style="width: 20%;">{{ rupiahFormat($total) }}</td>
                    </tr>
                </table>

                <hr>
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;" class="text-muted">Diskon</td>
                        <td class="text-muted text-right" style="width: 20%;">{{ rupiahFormat($disc) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 80%;" class="text-muted">Bayar</td>
                        <td class="text-muted text-right" style="width: 20%;">{{ rupiahFormat($payment) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 80%;" class="text-muted"><b>Grand total</b></td>
                        <td class="text-muted text-right" style="width: 20%;"><b>{{ rupiahFormat($grandTotal) }}</b></td>
                    </tr>
                    <td style="width: 80%;" class="text-muted">Kembalian</td>
                        <td class="text-muted text-right" style="width: 20%;">{{ rupiahFormat($change) }}</td>
                    </tr>
                </table>
                
                <?php $date = date("Y-m-d"); ?>
                <form action="/kasir/simpan-pembayaran" method="POST">
                    @csrf
                    <input type="hidden" id="inv" name="inv" value="{{ $inv }}">
                    <input type="hidden" id="total" name="total" value="{{ $total }}">
                    <input type="hidden" id="grandTotal" name="grandTotal" value="{{ $grandTotal }}">
                    <input type="hidden" id="disc" name="disc" value="{{ $disc }}">
                    <input type="hidden" id="date" name="date" value="{{ $date }}">

                    <button type="submit" id="saveTransaction" class="btn btn-success mb-4">
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection