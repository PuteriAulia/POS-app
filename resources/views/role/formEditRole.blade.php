<div class="modal" id="form-edit-role" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Ubah Role</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option btn-cls-modal" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div> 
                </div>
                <div class="block-content font-size-sm">
                    <input type="text" class="form-control form-control-alt" id="idEdit" name="id" hidden>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-alt" id="nameEdit" name="name">
                        <span class="text-danger error_text name_error"></span>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-primary update-role">Ubah</button>
                </div>
            </div>
        </div>
    </div>
</div>