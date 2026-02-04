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
                <h3>Upload Tracks</h3>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
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
                <form class="form-horizontal col-md-4 col-md-offset-4" id="form-uploadtracklist" name="form-uploadtrack" action="savetrack" method="POST" align="center" enctype="multipart/form-data" >
                    <input type="hidden" name="_token" value='{{ csrf_token() }}'>
                    <label>
                        Artist/Band
                        &nbsp;
                        <input name="artist" id="artist" type="text" data-validation="[NOTEMPTY]"  class="form-control">
                    </label><br>
                    <label>
                        Track Name
                        &nbsp;
                        <input name="track" id="track" type="text" data-validation="[NOTEMPTY]"  class="form-control">
                    </label><br>
                    <label>
                        Genre
                        &nbsp;
                        <input name="genre" id="genre" type="text" data-validation="[NOTEMPTY]"  class="form-control">
                    </label><br><br><br>
                    <input name="mp3" id="input-1a" type="file" class="file" data-show-preview="false"><br>
                    <button type="submit" class="form-control btn btn-success">Upload</button>
                    <br>
                </form>
                    <div class="row">

                    </div>
                <div class="panel-body">

                    <form class="form-vertical" action="deletetrack" method="POST" id="tableForm" role="form">
                        <input type="hidden" name="_token" value='{{ csrf_token() }}'>
                    </form>
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <th>Select</th>
                            <th>Artist/Band</th>
                            <th>Track Name</th>
                            <th>Genre</th>
                            <th>Play Track</th>
                        </thead>
                        @foreach($data as $track)
                            <tr>
                                <td>
                                    <input id="{{ $track->id }}" name="{{ $track->id }}" class="form-control" form="tableForm" type="checkbox">
                                </td>
                                <td>{{ $track->authors }}</td>
                                <td>{{ $track->song_name }}</td>
                                <td>{{ $track->genre }}</td>
                                <td><audio controls> <source src="{{ "audio/".$track->id }}" type="audio/mpeg">Your browser does not support the audio element.</audio></td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="row">

                        <div class="col-md-1">
                            <input class="form-control btn btn-danger" type="submit" value="Delete" form="tableForm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection