<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    private $months = [
        '01' => 'January','02' => 'February','03' => 'March','04' => 'April','05' => 'May','06' => 'Jun',
        '07' => 'July','08' => 'August','09' => 'September','10' => 'October','11' => 'November','12' => 'December',
    ];

    public function monthlyReports(Request $request)
    {
        $this->authorize('show-monthly-report');
        
        if(request()->ajax()) {

            $query = DB::table('expenses as e')
                ->join('expense_types as et', 'et.id', 'e.expense_type_id')
                ->join('users as u', 'u.id', 'e.created_by')
                ->join('destinations as d', 'd.id', 'e.destination_id')
                ->join('locations as fl', 'fl.id', 'd.travel_from_id')
                ->join('locations as tl', 'tl.id', 'd.travel_to_id')
                ->when(!Auth::user()->isAdmin(), function($query){
                    $query->where('e.created_by', Auth()->user()->id);
                })
                ->when($request->duration_form && $request->duration_to, function ($query) use ($request){
                    $duration_form  = Carbon::parse($request->duration_form)->format('Y-m-d');
                    $duration_to    = Carbon::parse($request->duration_to)->format('Y-m-d');
                    $query->whereBetween(DB::raw('DATE_FORMAT(e.duration_form, "%Y-%m-%d")'),  array($duration_form, $duration_to))
                        ->whereBetween(DB::raw('DATE_FORMAT(e.duration_to, "%Y-%m-%d")'), array($duration_form, $duration_to));
                })
                ->when($request->duration_form && empty($request->duration_to), function ($query) use ($request){
                    $duration_form  = Carbon::parse($request->duration_form)->format('Y-m-d');
                    $query->whereDate(DB::raw('DATE_FORMAT(e.duration_form, "%Y-%m-%d")'), $duration_form);
                })
                ->when($request->duration_to && empty($request->duration_form), function ($query) use ($request){
                    $duration_to    = Carbon::parse($request->duration_to)->format('Y-m-d');
                    $query->whereDate(DB::raw('DATE_FORMAT(e.duration_to, "%Y-%m-%d")'), $duration_to);
                })
                ->when($request->month, function ($query) use ($request){
                    $query->whereMonth('e.created_at', $request->month);
                })
                ->when($request->financial_year, function ($query) use ($request){
                    $query->whereYear('e.created_at', $request->financial_year);
                })
                ->select('e.id', 'et.name as expense_type', 'e.amount as expense_amount', 'u.name as user_name')
                ->selectRaw('CONCAT(DATE_FORMAT(e.duration_form, "%b %e, %Y %I:%i %p"), " - ", DATE_FORMAT(e.duration_to, "%b %e, %Y %I:%i %p")) as time_duration')
                ->selectRaw('concat(fl.name, " - ", tl.name) as destination');

            return datatables()->of($query)
                ->addIndexColumn()
                ->make(true);
        }

        $months = $this->months;
        $reports = new Collection();
        return view('reports.monthly-report', compact('reports', 'months'));     
    }

}
