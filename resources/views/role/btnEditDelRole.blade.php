<div class="text-center">
    <?php $roleId = Crypt::encrypt($data->id) ?>
    <button class="btn btn-sm btn-warning" id="modal-edit-role" data-id="{{ $roleId }}">
        <i class="si si-pencil"></i>
    </button>
    <button class="btn btn-sm btn-danger" id="btn-del" data-id="{{ $roleId }}">
        <i class="si si-trash"></i>
    </button>
</div>