@extends('layouts.mainLayouts')

@section('title','Report Transaksi | TokoKu')

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Report Transaksi
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Transaksi</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="/transaksi">Data</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Report</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content">
    <div class="row row-deck">
        <!-- Income -->
        <div class="col-sm-6 col-xl-6">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h3 font-w700">Rp{{ number_format($incomeTransaction) }}</dt>
                        <dd class="text-muted mb-0">Total Pendapatan</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-money-bill font-size-h3 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Income -->

        <!-- Sell Amount -->
        <div class="col-sm-6 col-xl-6">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">{{ $totalTransaction }}</dt>
                        <dd class="text-muted mb-0">Total Transaksi</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sell Amount -->
    </div>

    {{-- Table transaction --}}
    <div class="block block-rounded"> 
        <div class="block-content">
            <div class="table-responsive <?= $totalTransaction===0 ? 'd-none' : null ?>">
                <table id="report-transaction-table" class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">No</th>
                            <th class="text-center" style="width: 10%;">Kode</th>
                            <th class="text-center" style="width: 20%;">Tanggal</th>
                            <th class="text-center" style="width: 20%;">Total</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no=1;
                            foreach ($transaction as $data) {
                                ?>
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $data->transaction_code }}</td>
                            <td class="text-center">{{ dateFormat($data->transaction_date) }}</td>
                            <td>{{ rupiahFormat($data->transaction_grand_total) }}</td>
                            <td>
                                <div class="text-center">
                                    <?php $transactionId = Crypt::encrypt($data->transaction_code) ?>
                                    <a href="/transaksi/{{ $transactionId }}">
                                        <button class="btn btn-sm btn-primary" id="modal-detail-transaction">
                                            <i class="si si-eye"></i>
                                        </button>
                                    </a> 
                                </div>
                            </td>
                        </tr>
                        <?php
                            }    
                        ?>
                    </tbody>
                </table>
            </div>

            <div><h4 class="text-center text-muted <?= $totalTransaction!==0 ? 'd-none' : null ?>">Transaksi tidak ditemukan</h4></div>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- Page JS Code -->
<script src={{ asset("assets/js/pages/be_tables_datatables.min.js") }}></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush