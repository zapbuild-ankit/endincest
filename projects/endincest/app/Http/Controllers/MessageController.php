<?php
namespace App\Http\Controllers;

use App\UserNumber;
use Illuminate\Http\Request;

use Twilio\Rest\Client;

class MessageController extends Controller {

	// Show the forms with users phone number details.

	public function show() {
		$users = UserNumber::all();

		return view('phone_message.phone_message', compact("users"));
	}

	//Store a new user phone number

	public function storePhoneNumber(Request $request) {

		//run validation on data sent in
		$validatedData = $request->validate([
				'phone_number' => 'required|unique:user_numbers|numeric',
			]);

		$user_phone_number_model = new UserNumber($request->all());

		$user_phone_number_model->save();

		//$this->sendMessage('User Number added successful!!', $request->phone_number);

		return back()->with(['success' => "{$request->phone_number} registered"]);
	}

	//Send message to a selected users

	public function sendCustomMessage(Request $request) {
		$validatedData = $request->validate([
				'users' => 'required|array',
				'body'  => 'required',
			]);
		$recipients = $validatedData["users"];

		// iterate over the array of recipients and send a twilio request for each
		foreach ($recipients as $recipient) {
			$this->sendMessage($validatedData["body"], $recipient);
		}
		return back()->with(['success' => "Message sent successfully"]);
	}

	//sendmessage method

	private function sendMessage($message, $recipients) {

		$account_sid = getenv("TWILIO_ACCOUNT_SID");

		$auth_token = getenv("TWILIO_AUTH_TOKEN");

		$twilio_number = "+14242851877";

		$client = new Client($account_sid, $auth_token);

		$client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
	}
}