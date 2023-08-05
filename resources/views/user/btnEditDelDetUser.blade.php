<div class="text-center">
    <?php $userId = Crypt::encrypt($data->id) ?>
    <a href="user/{{ $userId }}">
        <button class="btn btn-sm btn-warning">
            <i class="si si-pencil"></i>
        </button>
    </a>
    <button class="btn btn-sm btn-danger" id="btn-del" data-id="{{ $userId }}">
        <i class="si si-trash"></i>
    </button>
</div>