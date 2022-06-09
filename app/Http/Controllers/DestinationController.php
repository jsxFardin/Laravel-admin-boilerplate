<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestinationRequest;
use App\Models\Destination;
use App\Models\Location;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('list-destination', Destination::class);

        if(request()->ajax()):
            $query = DB::table('destinations as d')
                ->join('locations as fl', 'fl.id', 'd.travel_from_id')
                ->join('locations as tl', 'tl.id', 'd.travel_from_id')
                ->select('d.id', 'fl.name as travel_from', 'tl.name as travel_to', 'd.amount', 'd.status');

            return datatables()->of($query)
                ->addColumn('action', 'destination.destination-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        endif;
        // exit;
        // $search = $request->get('search');

        // $destinations = Destination::whereHas('travel_from', function ($query) use ($search) {
        //     $query->where('name', 'like', '%' . $search . '%');
        // })->orWhereHas('travel_to', function ($query) use ($search) {
        //     $query->where('name', 'like', '%' . $search . '%');
        // })->paginate(5);

        return view('destination.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-destination', Destination::class);

        $locations = Location::all();
        return view('destination.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationRequest $request)
    {
        $this->authorize('create-destination', Destination::class);

        try {
            $travel_to          = Location::where('name', $request->travel_to)->first();
            $travel_from        = Location::where('name', $request->travel_from)->first();
            $checkDuplication   = Destination::where('travel_to_id', '=', $travel_to->id ?? 0)
                ->where('travel_from_id', '=', $travel_from->id ?? 0)->first();

            if($checkDuplication) {
                return redirect()->back()
                ->with('error', ucfirst($travel_from->name).' from '.ucfirst($travel_to->name).' already exist in our system!')
                ->withInput();
            }
            if($request->travel_to == $request->travel_from) {
                return redirect()->back()->with('error', 'Travel to and travel from are same!')->withInput();
            }
            if (!$travel_to) {
                $travel_to = Location::create(['name' => $request->travel_to]);
            }
            if (!$travel_from) {
                $travel_from = Location::create(['name' => $request->travel_from]);
            }
            $data = [
                'travel_from_id' => $travel_from->id,
                'travel_to_id' => $travel_to->id,
                'amount' => $request->amount
            ];

            Destination::create($data);
            Toastr::success('Destination successfully created!', 'Success');
            return redirect()->route('destination.index');
        } catch (\Exception $e) {

            Toastr::error($e->getMessage(), 'Error');
            return redirect()->route('destination.create')->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        $this->authorize('show-destination', Destination::class);

        return view('destination.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(DestinationRequest $request, Destination $destination)
    {
        $this->authorize('edit-destination', Destination::class);

        try {
            $travel_from = Location::where('name', $request->travel_from)->first();
            $travel_to = Location::where('name', $request->travel_to)->first();

            if (!$travel_from) {
                $travel_from = Location::create(['name' => $request->travel_from]);
            }
            if (!$travel_to) {
                $travel_to = Location::create(['name' => $request->travel_to]);
            }
            $data = [
                'travel_from_id' => $travel_from->id,
                'travel_to_id' => $travel_to->id,
                'amount' => $request->amount
            ];
            $destination->update($data);
            Toastr::success('Destination updated successfully!', 'Success');
            return redirect()->route('destination.index');
        } catch (\Exception $e) {

            Toastr::error($e->getMessage(), 'Error');
            return redirect()->route('destination.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        $this->authorize('delete-destination', Destination::class);

        try {

            $destination->delete();
            Toastr::success('Destination deleted successfully!', 'Success');
            return redirect()->route('destination.index');
        } catch (\Exception $e) {
            Toastr::error('Destination not deleted', 'Error');
            return redirect()->route('destination.index');
        }
    }
}
