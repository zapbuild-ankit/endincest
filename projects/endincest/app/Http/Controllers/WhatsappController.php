<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;

class WhatsappController extends Controller {

	//Method to show the Form for sending message

	public function index() {

		return view('whatsapp.whatsapp');
	}

	//Method for Sending whatsapp message

	public function sendMessage(Request $request) {
		$validator = Validator::make($request->all(), [
				'number'  => 'required',
				'message' => 'required',
			]);

		if ($validator->passes()) {

			if ($request->ajax()) {
				$chatid = $request->number;
				$text   = $request->message;
				$data   = array('chatId' => $chatid.'@c.us', 'body' => $text);
				$this->sendRequest('message', $data);
				return response()->json(['success' => 'WhatsApp Message sent successfully']);
			}
		}

		return response()->json(['error' => $validator->errors()->all()]);

	}

	//Method for sending request with whatsapp api and token

	public function sendRequest($method, $data) {

		$APIurl = getenv("WHATSAPP_API_URL");

		$token = getenv("WHATSAPP_TOKEN");

		$url = $APIurl.$method.'?token='.$token;

		if (is_array($data)) {$data = json_encode($data);}
		$options                    = stream_context_create(['http' => [
					'method'                                                 => 'POST',
					'header'                                                 => 'Content-type: application/json', 'content'                                                 => $data]]);
		$response = file_get_contents($url, false, $options);

		file_put_contents('requests.log', $response.PHP_EOL, FILE_APPEND);

	}
}
