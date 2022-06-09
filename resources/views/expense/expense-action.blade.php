@can('print-expense', \App\Models\Expense::class)
    <a class="btn btn-info btn-xs"
        title="Print {{ $expense_type }}"
        {{-- href="{{ route('expense.print', $id) }}" --}}
        href="#"
    >
        <i class="fas fa-print"></i>
    </a>
@endcan
@can('download-expense', \App\Models\Expense::class)
    <a class="btn btn-success btn-xs"
        title="Download {{ $expense_type }}"
        {{-- href="{{ route('expense.download', $id) }}" --}}
        href="#"
    >
        <i class="fas fa-download"></i>
    </a>
@endcan
@can('edit-expense', \App\Models\Expense::class)
    <a class="btn btn-primary btn-xs"
        title="Update {{ $expense_type }}"
        href="{{ route('expense.edit', $id) }}">
        <i class="fas fa-edit"></i>
    </a>
@endcan
@can('delete-expense', \App\Models\Expense::class)
    <a href="#" class="btn btn-danger btn-xs"
        title="Delete {{ $expense_type }}"
        data-toggle="modal"
        data-target="#delete-modal-{{ $id }}">
        <i class="fas fa-trash-alt"></i>
    </a>

    @include('layouts.includes.delete_modal', [
        'row' => $id,
        'name' => $expense_type,
        'url' => 'expense.destroy',
    ])
@endcan
