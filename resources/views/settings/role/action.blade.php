@can('edit-role', \App\Models\Role::class)
    <a class="btn btn-primary btn-xs" title="Update role" href="{{ route('role.edit', $id) }}">
        <i class="fas fa-edit"></i>
    </a>
@endcan
@can('delete-role', \App\Models\Role::class)
    <a href="#" class="btn btn-danger btn-xs" title="Delete role" data-toggle="modal"
        data-target="#delete-modal-{{ $id }}">
        <i class="fas fa-trash-alt"></i>
    </a>

    @include('layouts.includes.delete_modal', [
        'row' => $id,
        'name' => 'role',
        'url' => 'role.destroy',
    ])
@endcan
