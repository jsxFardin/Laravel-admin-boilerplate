<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestinationRequest;
use App\Models\Destination;
use App\Models\Location;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-destination', Destination::class);

        $destinations = Destination::with('travel_from', 'travel_to')->paginate(10);
        return view('destination.index', compact('destinations'));
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
            $checkDuplication   = Destination::where('travel_to_id', '=', $travel_to->id)
                                    ->where('travel_from_id', '=', $travel_from->id)->first();

            if($checkDuplication) {
                Toastr::error('This data already exist!', 'Error');
                return redirect()->back()->with('error', 'This data already exist!');
            }
            if($travel_to->id == $travel_from->id) {
                Toastr::error('Travel to and travel from are same!', 'Error');
                return redirect()->back()->with('error', 'Travel to and travel from are same!');
            }
            if (!$travel_to) {
                $travel_to = Location::create(['name' => $request->travel_to]);
            }
            if (!$travel_from) {
                $travel_from = Location::create(['name' => $request->travel_from]);
            }
            $data = [
                'travel_to_id' => $travel_to->id,
                'travel_from_id' => $travel_from->id,
                'amount' => $request->amount
            ];

            Destination::create($data);
            Toastr::success('Destination successfully created!', 'Success');
            return redirect()->route('destination.index');

        } catch (\Exception $e) {
            
            Toastr::error('Destination not created', 'Error');
            return redirect()->route('destination.create')->with('error', 'Destination not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        $this->authorize('edit-destination', Destination::class);

        return view('destination.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
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

            Toastr::error('Destination not updated', 'Error');
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
