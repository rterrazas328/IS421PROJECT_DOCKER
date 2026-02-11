@extends('myapp')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="jumbotron">
                <h1>MyUsic</h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default table-responsive">
                <h3>Edit Playlist</h3>
            </div>
        </div>
        <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ "/saveplaylist/" . $playlistID }}" method="POST" id="form" name="form" role="form">
                <input type="hidden" name="_token" value='{{ csrf_token() }}'>
            </form>
            <div class="col-xs-4">
                <label for="playlistname">Playlist Name:</label>
                <input class="form-control" id="playlistname" name="playlistName" value='{{ $playlistName }}' placeholder="Enter Playlist Name" type="text" form="form"><br>
            </div>
            <br>
            <br>
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <th>Select</th>
                <th>Artist/Band</th>
                <th>Track Name</th>
                <th>Genre</th>
                <th>Play Track</th>
                </thead>
                @foreach($data as $status => $track)
                    <tr>
                        <td>
                            @if(explode("_",$status)[1] == "on")
                                <input id="{{ $track->id }}" name="{{ $track->id }}" class="form-control" form="form" type="checkbox" checked>
                            @else
                                <input id="{{ $track->id }}" name="{{ $track->id }}" class="form-control" form="form" type="checkbox">
                            @endif
                        </td>
                        <td>{{ $track->authors }}</td>
                        <td>{{ $track->song_name }}</td>
                        <td>{{ $track->genre }}</td>
                        <td><audio controls><source src="{{ "audio/".$track->id }}" type="audio/mpeg">Your browser does not support the audio element.</audio></td>
                    </tr>
                @endforeach
            </table>
            <div class="row">
                <div class="col-md-1">
                    <input class="form-control btn btn-success" type="submit" form="form" value="Save">
                </div>
            </div>
        </div>
        </div>
        <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
        <script src="./js/createplaylist.js" ></script>
        <script src="./js/jquery.validation.js"></script>
    </section>
@endsection