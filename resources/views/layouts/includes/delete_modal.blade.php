<!-- delete modal -->
<div class="modal fade" id="delete-modal-{{$row->id}}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title"> Caution!! </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you want to delete ({{ $name }})?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                {{-- <a href="{{ route('location.destroy', $row->id) }}">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                    </button>
                </a> --}}

                <form action="{{ route($url, $row->id) }}"
                    method="Post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                    </button>
                </form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
