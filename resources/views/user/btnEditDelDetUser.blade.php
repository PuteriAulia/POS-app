<div class="text-center">
    <a href="user/{{ $data->id }}">
        <button class="btn btn-sm btn-warning">
            <i class="si si-pencil"></i>
        </button>
    </a>
    <button class="btn btn-sm btn-danger" id="btn-del" data-id="{{ $data->id }}">
        <i class="si si-trash"></i>
    </button>
</div>