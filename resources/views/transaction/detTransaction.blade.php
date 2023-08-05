<div class="text-center">
    <?php $transactionId = Crypt::encrypt($data->transaction_code) ?>
    <a href="/transaksi/{{ $transactionId }}">
        <button class="btn btn-sm btn-primary" id="modal-detail-transaction">
            <i class="si si-eye"></i>
        </button>
    </a> 
</div>