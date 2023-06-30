<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LocationController extends Controller
{

    public function index(Request $request)
    {   
        
        $locations = auth()->user()->locations;
        $selectedLocationId = $request->get("location");
        return view( "locations.index", compact("locations", "selectedLocationId"));
    }



    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            "name" => ["required", "string", "max:255"],
            "latitude" => ["required", "numeric", "min:-90", "max:90"],
            "longitude" => ["required", "numeric", "min:-180", "max:180"],
        ]);

        $location = new Location([
            "user_id" => auth()->id(),
            "name" => $request->get("name"),
            "latitude" => $request->get("latitude"),
            "longitude" => $request->get("longitude"),
        ]);

        $location->save();

        return Redirect::route("locations.index")->with(
            "status",
            "location-saved"
        );
    }
    

    public function show()
    {
        
        return view('locations.show', compact('locations'));
    }

    public function edit(Location $location)
    {
        return readirect("locations.edit", compact("location"));
    }

    public function update( LocationRequest $request,  Location $location): RedirectResponse
    {
        $location->fill($request->validated());

        $location->save();

        return redirect()->route("locations.index")->with("success", "Location saved!");
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect("/locations");
    }
}