<?php

namespace App\Http\Controllers;
use App\Location;
use Illuminate\Http\Request;

class GoogleMapController extends Controller {

	//Method to show the Google map with select options of location

	function CreateMap() {
		$locations = Location::all();

		return view('google_map.google_map', compact('locations'));
	}

	//Method to send coordinates according to selected cities

	function LocationCoords(Request $request) {

		if ($request->ajax()) {

			$cityval = $request->cityval;

			$col = Location::where('city', $cityval)->first();

			$lat = $col->lat;
			$lng = $col->lng;
			return response()->json([$lat, $lng]);
			//return [$lat, $lng];

		}

	}
}
