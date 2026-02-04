<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
class GuestController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('auth.main', ['page_name' => 'main']);
	}

	public function getUserName()
	{
		return view('auth.username', [ 'page_name' => 'username']);
	}

	public function postUserName(Request $request){
		$this->validate($request, [
			'honeypot' => 'required|in:IS-421-RRZ',
			'email' => 'required|email|max:50',
		]);

		$userEmail = $request->only('email');

		$results = DB::select('SELECT user FROM users WHERE email = :em', ['em' => $userEmail['email']]);

		$eMessage = "Your username is ".$results[0]['user'];

		if($results){
			Mail::raw($eMessage, function($message) use ($userEmail){

				$message->to($userEmail['email'])->subject('User Name Retrieval!');
			});
			return view('auth.login', [ 'page_name' => 'login']);
		}
		else{
			return view('auth.username', [ 'page_name' => 'username']);
		}

	}

}
