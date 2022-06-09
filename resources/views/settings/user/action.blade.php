@can('edit-user', \App\Models\User::class)
    <a class="btn btn-primary btn-xs" title="Update user" href="{{ route('user.edit', $id) }}">
        <i class="fas fa-edit"></i>
    </a>
@endcan
@can('delete-user', \App\Models\User::class)
    <a href="#" class="btn btn-danger btn-xs" title="Delete user" data-toggle="modal"
        data-target="#delete-modal-{{ $id }}">
        <i class="fas fa-trash-alt"></i>
    </a>

    @include('layouts.includes.delete_modal', [
        'row' => $id,
        'name' => 'user',
        'url' => 'user.destroy',
    ])
@endcan
