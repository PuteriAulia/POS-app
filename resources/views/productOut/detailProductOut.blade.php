<div class="modal" id="detail-productOut" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Detail Barang Keluar</h3>
                    <div class="block-options">
                        {{-- <button type="button" class="btn-block-option btn-close" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <h3 class="mb-1 text-gray-dark" id="productDetail"></h3>
                    <hr>
                    <table class="mb-3 text-gray-dark">
                        <tr>
                            <td>Tanggal</td>
                            <td id="dateDetail"></td>
                        </tr>
                        <tr>
                            <td>Jumlah barang keluar</td>
                            <td id="qtyDetail"></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td id="descDetail"></td>
                        </tr>
                    </table>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    {{-- <button type="button" class="btn btn-alt-primary mr-1 btn-close">Tutup</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>