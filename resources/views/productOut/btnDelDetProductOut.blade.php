<div class="text-center">
    <?php $productId = Crypt::encrypt($data->id) ?>
    <button class="btn btn-sm btn-primary" id="modal-detail-productOut" data-id="{{ $productId }}">
        <i class="si si-eye"></i>
    </button>
    <button class="btn btn-sm btn-danger" id="btn-del" data-id="{{ $productId }}">
        <i class="si si-trash"></i>
    </button>
</div>