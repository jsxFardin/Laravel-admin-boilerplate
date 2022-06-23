<div class="text-center">
    @can('edit-user', \App\Models\User::class)
        <a class="btn btn-primary btn-xs" title="Update user" href="{{ route('user.edit', $id) }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can('delete-user', \App\Models\User::class)
        <a href="#" class="btn btn-danger btn-xs" title="Delete user" onclick="loadUserDeleteModal({{ $id }})">
            <i class="fas fa-trash-alt"></i>
        </a>
    @endcan
</div>
