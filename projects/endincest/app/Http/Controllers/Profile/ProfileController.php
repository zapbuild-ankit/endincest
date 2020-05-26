<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Image;

class ProfileController extends Controller {

	public function index() {

		return view('profile.profile');
	}

	public function editprofile() {
		$user = auth::user();

		return view('profile.editprofile', compact('user'));
	}

	public function updateprofile(Request $request) {
		$user = Auth::user();

		$this->validate($request, [
				'name'  => 'required|max:255'.$user->id,
				'email' => 'required|email|max:255|unique:users,email,'.$user->id,

			]);
		$this->validate($request, ['profile_pic' => 'required']);

		if ($request->hasFile('profile_pic')) {

			$file     = $request->file('profile_pic');
			$filename = time().'.'.$file->getClientOriginalExtension();

			Image::make($file)->resize(300, 300)->save(public_path('/dist/img/'.$filename));

		}

		$input             = $request->only('name', 'email');
		$user->profile_pic = $filename;
		$user->save();
		$user->update($input);
		return redirect('/profile');

	}

	public function addimage(Request $request) {

		$this->validate($request, ['profile_pic' => 'required']);

		if ($request->hasFile('profile_pic')) {

			$file     = $request->file('profile_pic');
			$filename = time().'.'.$file->getClientOriginalExtension();
			Image::make($file)->resize(300, 300)->save(public_path('/dist/img/'.$filename));

		}
		$users = auth::user();

		$users->profile_pic = $filename;

		$users->save();

		return redirect('\profile');

	}

	public function viewimage() {
		return view('profile.viewimage');
	}
}
