@extends('layouts.mainLayouts')

@section('title','Detail Transaksi | TokoKu')

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Detail Transaksi
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Transaksi</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="/transaksi">Data</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Detail</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-xl-7">
        <div class="block block-rounded block-themed">
            <div class="block-header bg-modern">
                <h3 class="block-title">Detail Transaksi</h3>
                <?php foreach($transaction as $data): ?>
                <a href="/transaksi/printDetail/{{ $data->transaction_code }}">
                    <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-print"></i> Print</button>
                </a> 
                <?php endforeach; ?>
            </div>
            <div class="block-content">
                <?php foreach($transaction as $data): ?>
                <p class="text-muted">{{ ucwords($data->user->name) }} | {{ $data->transaction_code }}</p>
                <h3>TOTAL : Rp {{ number_format($data->transaction_grand_total) }}</h3>
                <hr>
                <?php endforeach; ?>

                <p class="text-muted">Detail Pembelian</p>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-muted">Nama barang</th>
                            <th class="text-muted">Harga</th>
                            <th class="text-muted">Qty</th>
                            <th class="text-muted">Sub total</th>
                        </tr>
                        <?php 
                            $tanggal = date("Y-m-d");
                            foreach ($transactionDetail as $data) {
                        ?> 
                        <tr>
                            <td class="text-muted" style="width: 50%;">{{ $data->product->product_name }}</td>
                            <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($data->detail_price) }}</td>
                            <td class="text-muted" style="width: 10%;">{{ $data->detail_qty }}</td>
                            <td class="text-muted text-right" style="width: 20%;">{{ number_format($data->detail_subtotal) }}</td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
                <hr>

                <?php foreach ($transaction as $data) { ?>
                <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;"><h4 class="text-muted">Total transaksi</h4></td>
                        <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($data->transaction_total) }}</td>
                    </tr>
                </table>

                <hr>
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 80%;" class="text-muted">Diskon</td>
                        <td class="text-muted text-right" style="width: 20%;">Rp {{ number_format($data->transaction_disc) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 80%;" class="text-muted"><b>Grand total</b></td>
                        <td class="text-muted text-right" style="width: 20%;"><b>Rp {{ number_format($data->transaction_grand_total) }}</b></td>
                    </tr>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
@endsection