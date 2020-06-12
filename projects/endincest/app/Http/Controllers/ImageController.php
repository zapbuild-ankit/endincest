<?php

namespace App\Http\Controllers;
use App\Image;
use Illuminate\Http\Request;
use Validator;

class ImageController extends Controller {

	// Method for image select with crop option

	public function index() {
		return view('image.image_crop');

	}

	// Method to upload cropped image

	function upload(Request $request) {

		$validator = Validator::make($request->all(), [
				'Image' => 'required',
			]);

		if ($validator->passes()) {

			if ($request->ajax()) {

				$image_data = $request->image;

				$image_array_1 = explode(";", $image_data);

				$image_array_2 = explode(",", $image_array_1[1]);
				$data          = base64_decode($image_array_2[1]);
				$image_name    = time().'.jpeg';
				$upload_path   = public_path('crop_image/'.$image_name);
				file_put_contents($upload_path, $data);
				$image        = new Image;
				$image->image = $image_name;
				$image->save();

				return response()->json(['path' => '/crop_image/'.$image_name]);
			}

		}

		return response()->json(['error' => $validator->errors()->all()]);
	}

}
