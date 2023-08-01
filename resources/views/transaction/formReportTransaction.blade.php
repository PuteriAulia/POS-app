<div class="modal" id="form-report" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Report Transaksi</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option btn-cls-modal" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div> 
                </div>
                <form action="transaksi/report" method="post">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <label for="startPeriode">Periode awal</label>
                            <input type="date" class="form-control form-control-alt" id="startPeriode" name="startPeriode" placeholder="Masukkan batas awal periode..">
                            <span class="text-danger error_text startPeriode_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="lastPeriode">Periode akhir</label>
                            <input type="date" class="form-control form-control-alt" id="lastPeriode" name="lastPeriode" placeholder="Masukkan batas akhir periode..">
                            <span class="text-danger error_text lastPeriode_error"></span>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="submit" class="btn btn-primary report-transaction">Cek</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>