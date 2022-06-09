<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Destination;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $this->authorize('list-expense', Expense::class);

        if (request()->ajax()) {
            $query = DB::table('expenses as e')
                ->join('expense_types as et', 'et.id', 'e.expense_type_id')
                ->join('users as u', 'u.id', 'e.created_by')
                ->join('destinations as d', 'd.id', 'e.destination_id')
                ->join('locations as fl', 'fl.id', 'd.travel_from_id')
                ->join('locations as tl', 'tl.id', 'd.travel_to_id')
                ->when(!Auth::user()->isAdmin(), function ($query) {
                    $query->where('e.created_by', Auth()->user()->id);
                })
                ->select('e.id', 'et.name as expense_type', 'e.amount as expense_amount', 'e.status as expense_status', 'u.name as created_by')
                ->selectRaw('CONCAT(DATE_FORMAT(e.duration_form, "%b %e, %Y %I:%i %p"), " - ", DATE_FORMAT(e.duration_to, "%b %e, %Y %I:%i %p")) as time_duration')
                ->selectRaw('DATE_FORMAT(e.created_at, "%b %e, %Y %I:%i %p") as created_at')
                ->selectRaw('concat(fl.name, " - ", tl.name) as destination');

            return datatables()->of($query)
                ->addColumn('action', 'expense.expense-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('expense.index');
    }

    public function create()
    {
        $this->authorize('create-expense', Expense::class);

        $expenseType = ExpenseType::select('id', 'name')->get();
        return view('expense.create', compact('expenseType'));
    }

    public function store(ExpenseRequest $request)
    {
        $this->authorize('create-expense', Expense::class);

        try {
            $request->duration_to = new Carbon($request->duration_to);
            $request->duration_form = new Carbon($request->duration_form);

            $data = $this->storeData($request);
            Expense::create($data);
            Toastr::success('Expense successfully created!', 'Success');
            return redirect()->route('expense.index')->withInput();
        } catch (\Exception $error) {

            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back()->with('error', $error->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $this->authorize('show-expense', Expense::class);

        $expense        = Expense::find($id);
        $expenseType    = ExpenseType::select('id', 'name')->get();
        return view('expense.edit', compact('expense', 'expenseType'));
    }

    public function update(ExpenseRequest $request, $id)
    {
        $this->authorize('edit-expense', Expense::class);

        try {
            $request->duration_to = new Carbon($request->duration_to);
            $request->duration_form = new Carbon($request->duration_form);

            $expense = Expense::findOrFail($id);
            $data = $this->storeData($request, $expense);
            $expense->update($data);
            Toastr::success('Expense successfully updated!', 'Success');
            return redirect()->route('expense.index')->withInput();
        } catch (\Exception $error) {

            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->authorize('delete-expense', Expense::class);

        try {
            Expense::where('id', $id)->delete();
            Toastr::success('Expense successfully deleted!', 'Success');
            return redirect()->back();
        } catch (\Exception $error) {

            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back();
        }
    }

    private function storeData($request, $expense = null)
    {
        $data = [
            'expense_type_id'       => $request->expense_type_id,
            'destination_id'        => $request->destination_id,
            'description'           => $request->description,
            'duration_to'           => $request->duration_to,
            'duration_form'         => $request->duration_form,
            'amount'                => $request->amount,
            'created_by'            => Auth::user()->id,
            'created_at'            => $expense ? $expense->created_at : Carbon::now(),
            'updated_at'            => $expense ? Carbon::now() : null
        ];

        if (Auth::user()->isAdmin()) { //CHECK ADMIN OR NOT
            $data['status'] = '1';
            $data['approved_by'] = Auth::user()->id;
        }
        return $data;
    }

    public function approve($id, $status)
    {
        $this->authorize('approve-expense', Expense::class);

        try {
            $expense = Expense::findOrFail($id);
            $expense->update(['status' => $status == 1 ? '0' : '1']);
            if ($status == 1) {
                Toastr::warning('Expense successfully pending!', 'Warning');
            } else {
                Toastr::success('Expense successfully approved!', 'Success');
            }
            return redirect()->back();
        } catch (\Exception $error) {

            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back();
        }
    }

    public function autocomplete(Request $request)
    {
        $this->authorize('list-expense', Expense::class);

        if ($request->input('term')) {

            $query = $request->term;
            $destination = DB::table('destinations')
                ->select('form_location.name as form_name', 'to_location.name as to_name')
                ->leftJoin('locations as form_location', 'form_location.id', 'destinations.travel_from_id')
                ->leftJoin('locations as to_location', 'to_location.id', 'destinations.travel_to_id')
                ->where('destinations.status', '=', 1)
                ->where('form_location.name', 'LIKE', '%' . $query . '%')
                ->orWhere('to_location.name', 'LIKE', '%' . $query . '%')
                ->get();

            $result = [];
            foreach ($destination as $value) {
                $result[] = $value->form_name;
                $result[] = $value->to_name;
            }
            return response()->json(array_unique($result));
        }
        if ($request->input('travel_to') && $request->input('travel_form')) {

            $travel_to = $request->travel_to;
            $travel_form = $request->travel_form;
            $destination = DB::table('destinations')
                ->select('destinations.id', 'destinations.amount')
                ->leftJoin('locations as form_location', 'form_location.id', 'destinations.travel_from_id')
                ->leftJoin('locations as to_location', 'to_location.id', 'destinations.travel_to_id')
                ->where('destinations.status', '=', 1)
                ->where('form_location.name', '=', $travel_form)
                ->where('to_location.name', '=', $travel_to)
                ->first();

            return $destination ? $destination : [];
        }
    }

    public function approveIndex()
    {
        $this->authorize('list-expense', Expense::class);

        if (request()->ajax()) {
            $query = DB::table('expenses as e')
                ->join('expense_types as et', 'et.id', 'e.expense_type_id')
                ->join('users as u', 'u.id', 'e.created_by')
                ->join('destinations as d', 'd.id', 'e.destination_id')
                ->join('locations as fl', 'fl.id', 'd.travel_from_id')
                ->join('locations as tl', 'tl.id', 'd.travel_to_id')
                ->when(!Auth::user()->isAdmin(), function ($query) {
                    $query->where('e.created_by', Auth()->user()->id);
                })
                ->select('e.id', 'et.name as expense_type', 'e.description as description', 'e.amount as expense_amount', 'e.status as expense_status', 'u.name as created_by')
                ->selectRaw('CONCAT(DATE_FORMAT(e.duration_form, "%b %e, %Y %I:%i %p"), " - ", DATE_FORMAT(e.duration_to, "%b %e, %Y %I:%i %p")) as time_duration')
                ->selectRaw('DATE_FORMAT(e.created_at, "%b %e, %Y %I:%i %p") as created_at')
                ->selectRaw('concat(fl.name, " - ", tl.name) as destination');

            return datatables()->of($query)
                ->addColumn('action', 'expense.approve.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('expense.approve.index');
    }
}
