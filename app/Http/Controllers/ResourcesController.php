<?php namespace App\Http\Controllers;

use App\UserProfile;
use App\Track;
use Auth;
use Storage;

class ResourcesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function loadImage(){
        $userID = Auth::user()['id'];
        $path = UserProfile::find($userID)->profile_picture;

        $testpath = basename($path);

        if (Storage::exists("images/".$userID."/".$testpath))
        {
            return response()->download($path);
        }

        return response()->download(storage_path()."/app/images/default/icon.png");
    }

    public function loadAudio($id){
        $userID = Auth::user()['id'];
        $track = Track::find($id);

        $path = $track->file_path;

        $testpath = basename($path);

        if (Storage::exists("audio/".$userID."/".$testpath)){
            return response()->download($path);
        }

        return;

    }

}