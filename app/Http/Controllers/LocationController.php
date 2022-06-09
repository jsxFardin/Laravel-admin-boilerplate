<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Destination;
use App\Models\Location;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-location', Location::class);

        $locations = Location::paginate(10);
        return view('location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-location', Location::class);

        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $this->authorize('create-location', Location::class);

        $location       = new Location;
        $location->name = $request->name;
        $location->save();
        Toastr::success('Location successfully created!', 'Success');
        return redirect()->route('location.index')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $this->authorize('show-location', $location);

        return view('location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        $this->authorize('edit-location', $location);

        $location->name = $request->name;
        $location->save();
        Toastr::success('Location successfully updated!', 'Success');
        return redirect()->route('location.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $this->authorize('delete-location', $location);

        $location->delete();
        Toastr::error('Location successfully deleted!', 'Error');
        return redirect()->back();
    }

    public function autocomplete(Request $request)
    {
        $this->authorize('list-destination', Destination::class);

        $term = $request->term;
        $data = Location::where('name', 'LIKE', '%' . $term . '%')->get();
        $result = [];
        foreach ($data as $key => $value) {
            $result[] =  $value->name;
        }
        return response()->json($result);
    }
}
