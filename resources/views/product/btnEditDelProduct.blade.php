<div class="text-center">
    <?php $productId = Crypt::encrypt($data->id) ?>
    <a href="/barang/{{ $productId }}/edit">
        <button class="btn btn-sm btn-warning" id="modal-edit-product">
            <i class="si si-pencil"></i>
        </button>
    </a>
    <button class="btn btn-sm btn-danger" id="btn-del" data-id="{{ $productId }}">
        <i class="si si-trash"></i>
    </button>
</div>