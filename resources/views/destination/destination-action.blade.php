@can('edit-destination', \App\Models\Destination::class)
    <a class="btn btn-primary btn-xs"
        title="Update {{ $travel_from . ' To ' . $travel_to }}"
        href="{{ route('destination.edit', $id) }}">
        <i class="fas fa-edit"></i>
    </a>
@endcan
@can('delete-destination', \App\Models\Destination::class)
    <a href="#" class="btn btn-danger btn-xs"
        title="Delete {{ $travel_from . ' To ' . $travel_to }}" data-toggle="modal"
        data-target="#delete-modal-{{ $id }}">
        <i class="fas fa-trash-alt"></i>
    </a>

    @include('layouts.includes.delete_modal', [
        'row' => $id,
        'name' =>
            $travel_from .
            ' To ' .
            $travel_to,
        'url' => 'destination.destroy',
    ])
@endcan
