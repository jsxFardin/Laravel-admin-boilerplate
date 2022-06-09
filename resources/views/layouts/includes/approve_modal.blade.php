<!-- delete modal -->
<div class="modal fade" id="approve-modal-{{$id}}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title"> Caution!! </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you want to approve ({{ $name }})?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                <a href="{{ url($url) }}">
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="fas fa-check"></i>
                        Approved
                    </button>
                </a>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
