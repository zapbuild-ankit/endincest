<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class AdminController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');
	}

	//Method to show admin dash

	public function admindash() {
		return view('admin.admindash');

	}

	//Method to show event form

	public function eventform() {
		return view('admin.eventform');
	}

	//Method to add event

	public function addevent(Request $request) {
		if ($request->hasFile('image')) {

			$file     = $request->file('image');
			$filename = time().'.'.$file->getClientOriginalExtension();
			Image::make($file)->resize(300, 300)->save(public_path('/dist/img/'.$filename));

		}

		$validatedData = $request->validate([
				'name'        => 'required|max:255',
				'description' => 'required|max:255',
				'location'    => 'required|max:255',
				'speaker'     => 'required|max:255',
				'start_date'  => 'required',
				'end_date'    => 'required',
				'status'      => 'required',

			]);
		$event              = new Event;
		$event->name        = $request->name;
		$event->description = $request->description;
		$event->location    = $request->location;
		$event->speaker     = $request->speaker;
		$event->start_date  = $request->start_date;
		$event->end_date    = $request->end_date;
		$event->image       = $filename;
		$event->save();

		return redirect('/eventschedule')->with('success', 'Event is successfully saved');
	}

	//Method to show event schedule

	public function eventschedule() {

		$events = DB::table('events')->paginate(15);

		return view('admin.eventlist', compact('events'))
			->with('i', (request()->input('page', 1)-1)*5);
	}

	//Method to destroy event

	public function destroy($id) {

		$event = Event::findOrFail($id);

		$event->delete();

		return redirect('/eventschedule')->with('success', 'Event is successfully deleted');
	}

	//Method to edit event form

	public function editeventform($id) {
		$event = Event::findOrFail($id);
		return view('admin.editeventform', compact('event'));
	}

	//Method to update event

	public function updateevent(Request $request, $id) {
		$event = Event::findOrFail($id);

		$this->validate($request, ['name' => 'required', 'description' => 'required', 'location' => 'required', 'speaker' => 'required', 'start_date' => 'required', 'end_date' => 'required', 'status' => 'required', 'image' => 'required']);
		if ($request->hasFile('image')) {

			$file     = $request->file('image');
			$filename = time().'.'.$file->getClientOriginalExtension();

			Image::make($file)->resize(300, 300)->save(public_path('/dist/img/'.$filename));

		}

		$event->image = $filename;
		$input        = $request->only('name', 'description', 'location', 'speaker', 'start_date', 'end_date', 'status');
		$event->save();
		$event->update($input);
		return redirect('/eventschedule');

	}

}
