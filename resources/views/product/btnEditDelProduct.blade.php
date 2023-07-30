<div class="text-center">
    <a href="/barang/{{ $data->id }}/edit">
        <button class="btn btn-sm btn-warning" id="modal-edit-product">
            <i class="si si-pencil"></i>
        </button>
    </a>
    <button class="btn btn-sm btn-danger" id="btn-del" data-id="{{ $data->id }}">
        <i class="si si-trash"></i>
    </button>
</div>