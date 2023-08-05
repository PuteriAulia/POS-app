<div class="text-center">
    <?php $suplierId = Crypt::encrypt($data->id) ?>
    <button class="btn btn-sm btn-warning" id="modal-edit-suplier" data-id="{{ $suplierId }}">
        <i class="si si-pencil"></i>
    </button>
    <button class="btn btn-sm btn-danger" id="btn-del" data-id="{{ $suplierId }}">
        <i class="si si-trash"></i>
    </button>
</div>