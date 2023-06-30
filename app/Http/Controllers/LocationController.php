<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function index(Request $request)
    {   
        
        $locations = auth()->user()->locations;
        $selectedLocationId = $request->get("location");
        return view( "locations", compact("locations", "selectedLocationId"));
    }

    public function create()
    {
        return view("locations.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            "longitude" => ["required", "string"],
            "latitude" => ["required","string"],
            
        ]);
            
        $location = new Location([
            "user_id" => auth()->id(),
            "name" => $request->get("name"),
            "longitude" => $request->get("longitude"),
            "latitude" => $request->get("latitude"),
        ]); 

        $location->save();

        return Redirect::route("locations")->with(
            "status",
            "location-saved");
    }

    public function show()
    {
        
        return view('locations.show', compact('locations'));
    }

    public function edit(Location $location)
    {
        return readirect("locations.edit", compact("location"));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            "name" => "required",
            "longitude" => "required",
            "latitude" => "required",
        ]);

        $location->fill([
            "name" => $request->get("name"),
            "longitude" => $request->get("longitude"),
            "latitude" => $request->get("latitude"),
        ]);

        $location->save();

        return redirect("/locations");
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect("/locations");
    }
}