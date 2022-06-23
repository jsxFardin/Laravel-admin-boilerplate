<!-- delete modal -->
<div class="modal fade" id="{{ $modalId }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title"> Caution!! </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you want to delete?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger btn-sm" onclick="{{ $methodName }}()">
                    <i class="fas fa-trash-alt"></i>
                    Delete
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
