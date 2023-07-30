<div class="modal fade" id="process-payment" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Proses pembayaran</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content font-size-sm">
                <label class="text-mute">Total belanja</label>
                <h1 class="text-mute">{{ rupiahFormat($total) }}</h1>
                <hr>

                <form action="/kasir/pembayaran" method="POST">
                    @csrf
                    <input type="text" id="totalPayment" value="{{ $total }}" name='total' hidden>
                    <input type="text" id="invoicePayment" value="{{ $inv }}" name='inv' hidden>

                    <div class="form-group">
                        <label>Jumlah pembayaran</label>
                        <input type="number" class="form-control form-control-alt" id="payment" name="payment" placeholder="Jumlah uang pembayaran.." required>
                    </div>

                    <div class="form-group">
                        <label>Diskon</label>
                        <input type="number" class="form-control form-control-alt" id="discPayment" name="disc" placeholder="Jumlah diskon.." required>
                    </div>

                    <div class="block-content block-content-full text-right border-top">
                        <button type="submit" id="btn-process-payment" class="btn btn-primary">Proses</button>
                    </div>             
                </form>
            </div>
        </div>
    </div>
</div>

