<?php

namespace App\Http\Controllers;
use App\Location;
use Illuminate\Http\Request;
use Validator;

class GoogleMapController extends Controller {

	//Method to show the Google map with select options of location

	function create_map() {
		$locations = Location::all();

		return view('google_map.google_map', compact('locations'));
	}

	//Method to send coordinates according to selected cities

	function location_coords(Request $request) {

		$validator = Validator::make($request->all(), [
				'city' => 'required',
			]);

		if ($validator->passes()) {

			if ($request->ajax()) {

				$cityval = $request->city;

				if (!empty($cityval)) {

					$col = Location::where('city', $cityval)->first();

					if (!empty($col)) {

						$lat = $col->lat;
						$lng = $col->lng;
						return response()->json([$lat, $lng]);

					}
				}

			}

		} else {
			return response()->json(['error' => $validator->errors()->all()]);
		}

	}
}
