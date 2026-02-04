<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RequestF;
use DB;
use Mail;
use Auth;
use Illuminate\Http\RedirectResponse;
use Storage;
use App\Track;
use App\Playlist;

class MusicController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTracks(){
        $userID = Auth::user()['id'];

        $userTracks = DB::select('SELECT * FROM music where band_id = ?', [$userID]);

        return view('tracks', [ 'data' => $userTracks, 'page_name' => 'tracks']);
    }

    public function getPlaylists(){
        $userID = Auth::user()['id'];

        $userPlaylists = DB::select('SELECT * FROM playlists where user_id = ?', [$userID]);

        return view('playlists', [ 'data' => $userPlaylists, 'page_name' => 'playlists']);
    }

    public function getCreatePlaylist(){
        $userID = Auth::user()['id'];

        $userTracks = DB::select('SELECT * FROM music where band_id = ?', [$userID]);

        return view('createplaylist', [ 'data' => $userTracks, 'page_name' => 'createplaylist']);
    }

    public function saveTrack(Request $request){
        $this->validate($request, [
            'mp3' => 'max:7000',
        ]);
        $userID = Auth::user()['id'];

        if (RequestF::hasFile('mp3')){
            $file = RequestF::file('mp3');
            if ($file->isValid()){
                $target_dir = "audio/".$userID;
                //if target_dir doesn't exist, create it
                if(!is_dir($target_dir)){
                    Storage::makeDirectory($target_dir);
                }

                if($file->move(storage_path() . "/app/" .$target_dir, $file->getClientOriginalName())){

                    //if($track == null) {
                        $track = new Track;
                        //fill in fields
                        $track->band_id = $userID;
                        $track->song_name = RequestF::input('track');
                        $track->authors = RequestF::input('artist');
                        $track->file_path = storage_path() . "/app/" . $target_dir . "/" . $file->getClientOriginalName();

                        $track->save();
                        return new RedirectResponse(url('/tracks'));
                    //}
                }
            }
        }

        return new RedirectResponse(url('/tracks'));
    }

    public function deleteTrack(){
        $userID = Auth::user()['id'];

        $data=RequestF::all();

        foreach ($data as $name => $val){

            if ($val == "on"){

                //find corresponding model
                $track = Track::find($name);

                //delete the model
                if($track != null){
                    $trackID = $track->id;
                    $track->delete();
                    //remove from playlist_songs
                    DB::delete('DELETE FROM playlist_songs where track_id = ?', [$trackID]);
                }

            }
        }

        return new RedirectResponse(url('/tracks'));
    }

    public function savePlaylist(Request $request, $id = null){

        $this->validate($request, [
            'playlistName' => 'required|string|max:20',
        ]);

        $userID = Auth::user()['id'];

        if($id != null){
            $playlist = Playlist::find($id);
            if($playlist == null){
                //create new
                $playlist = new Playlist;
            }
        }
        else{
            //create new
            $playlist = new Playlist;
        }

        //fill in fields
        $playlist->user_id = $userID;
        $playlist->playlist_name = RequestF::input('playlistName');

        //create playlist
        $playlist->save();

        $insertedID = $playlist->id;
            //for each checkbox checked add song in playlist songs table
        $data=RequestF::all();

        foreach ($data as $name => $val){

            if ($val == "on"){

                //find corresponding model
                $track = Track::find($name);

                //delete the model
                if($track != null){
                    DB::insert('INSERT INTO playlist_songs (playlist_id, track_id) values (?, ?)', [$insertedID, $name]);
                }

            }
        }

        return new RedirectResponse(url('/playlists'));
    }

    public function deletePlaylist(Request $request){

        $this->validate($request, [
            'delete' => 'required',
        ]);

        $playlistID = RequestF::input('delete');

        $playlist = Playlist::find($playlistID);

        if($playlist != null){
            $playlist->delete();
            DB::delete('DELETE FROM playlist_songs where playlist_id = ?', [$playlistID]);
        }

        return new RedirectResponse(url('/playlists'));
    }

    public function editPlaylist($id, Request $request){
        $playlist = Playlist::find($id);

        $pName = $playlist->playlist_name;

        $userID = Auth::user()['id'];
        $playlistTrackIDs = DB::select('SELECT track_id FROM playlist_songs where playlist_id = ?', [$id]);

        $userTracks = DB::select('SELECT * FROM music where band_id = ?', [$userID]);

        $tracksData = array();

        foreach($userTracks as $track){

            $inArray = false;

            foreach($playlistTrackIDs as $trackID){
                if($track->id == $trackID->track_id){
                    $inArray = true;
                }
            }

            if($inArray){
                $tracksData[$track->id."_on"] = $track;
            }
            else{
                $tracksData[$track->id."_off"] = $track;
            }
        }
        $tracksData = $tracksData;

        return view('editplaylist', [ 'playlistName' => $pName, 'playlistID' => $id , 'data' =>  $tracksData,'page_name' => 'editplaylist']);
    }

}