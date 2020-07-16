<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Image;

class ProfileController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');
	}

	protected $validationRules = [
		'current-password' => 'required',
		'new-password'     => 'required',
	];

	//Method to show profile

	public function index() {

		return view('profile.profile');
	}

	//Method to edit profile

	public function editprofile() {
		$user = auth::user();

		return view('profile.editprofile', compact('user'));
	}

	//Method to update profile

	public function updateprofile(Request $request) {
		$user = Auth::user();

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

	//Method to add image

	public function addimage(Request $request) {

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
	//Method to view image

	public function viewimage() {
		return view('profile.viewimage');
	}
	//Method to show change password form

	public function showChangePasswordForm() {

		return view('auth.passwords.changepassword');
	}

	//Method for changing password

	public function changePassword(Request $request) {

		if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
			// The passwords matches

			return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
		}

		if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
			//Current password and new password are same
			return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
		}

		$validatedData = $request->validate([
				'current_password' => 'required',
				'new_password'     => 'required|string|min:6|confirmed',
			]);

		//Change Password
		$user           = Auth::user();
		$user->password = bcrypt($request->get('new_password'));
		$user->save();

		return redirect()->back()->with("success", "Password changed successfully !");

	}

}
