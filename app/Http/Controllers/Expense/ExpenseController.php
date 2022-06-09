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

        $expenses = Expense::paginate(10);
        return view('expense.index', compact('expenses'));
    }

    public function create()
    {
        $this->authorize('create-expense', Expense::class);

        $expenseType = ExpenseType::select('id', 'name')->get();
        return view('expense.create', compact('expenseType'));
    }

    public function store(ExpenseRequest $request)
    {
        // return($request);
        $this->authorize('create-expense', Expense::class);
        return $request;
        try {
            $data = $this->storeData($request);
            Expense::create($data);
            Toastr::success('Expense successfully created!', 'Success');
            return redirect()->route('expense.index')->withInput();

        } catch (\Exception $error) {

            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $this->authorize('show-expense', Expense::class);

        $expense = Expense::find($id);
        return view('expense.edit', compact('expense'));
    }

    public function update(ExpenseRequest $request, $id)
    {
        $this->authorize('edit-expense', Expense::class);

        try {
            $expense = Expense::findOrFail($id);
            $data = $this->storeData($request, $expense);
            $expense->update($data);
            Toastr::success('Expense successfully updated!', 'Success');
            return redirect()->route('expense.index')->withInput();

        } catch (\Exception $error) {
            
            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $this->authorize('delete-expense', Expense::class);

        try {
            Expense::where('id', $id)->delete();
            Toastr::error('Expense successfully deleted!', 'Error');
            return redirect()->back();

        } catch (\Exception $error) {

            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back();
        }
    }

    private function storeData($request, $expense = null)
    {
        $data = [
            'title'                 => $request->title,
            'description'           => $request->description,
            'duration_to'           => $request->duration_to,
            'duration_form'         => $request->duration_form,
            'travel_to'             => $request->travel_to,
            'travel_form'           => $request->travel_form,
            'amount'                => $request->amount,
            'created_by'            => Auth::user()->id,
            'created_at'            => $expense ? $expense->created_at : Carbon::now(),
            'updated_at'            => $expense ? Carbon::now() :null
        ];

        if (Auth::user()->isAdmin()) { //CHECK ADMIN OR NOT
            $data['status'] = '1';
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

        if ($request->input('term') ) {

            $query = $request->term;
            $destination = DB::table('destinations')
                ->select('form_location.name as form_name', 'to_location.name as to_name')
                ->leftJoin('locations as form_location', 'form_location.id', 'destinations.travel_from_id')
                ->leftJoin('locations as to_location', 'to_location.id', 'destinations.travel_to_id')
                ->where('destinations.status', '=', 1)
                ->where('form_location.name', 'LIKE', '%'.$query.'%')
                ->orWhere('to_location.name', 'LIKE', '%'.$query.'%')
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

}
