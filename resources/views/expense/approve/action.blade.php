@can('approve-expense', \App\Models\Expense::class)
    <a class="btn btn-info btn-xs" title="Show details of {{ $expense_type }}" href="">
        <i class="fas fa-eye"></i>
    </a>
@endcan
@if ($expense_status != 1)
    @can('approve-expense', \App\Models\Expense::class)
        <a href="#" class="btn btn-success btn-xs" title="Approve {{ $expense_type }}"
            href="{{ route('expense.approve', [$id, $expense_status]) }}" data-toggle="modal"
            data-target="#approve-modal-{{ $id }}">
            <i class="fas fa-check"></i>
        </a>

        @include('layouts.includes.approve_modal', [
            'id' => $id,
            'name' => $expense_type,
            'url' => 'expense/approve/' . $id . '/' . $expense_status,
        ])
    @endcan
@endif
