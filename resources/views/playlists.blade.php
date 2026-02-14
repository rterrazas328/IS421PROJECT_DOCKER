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
                <h3>My Playlists</h3>
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
            <form action="editplaylist" method="POST" id="editForm" role="form">
                <input type="hidden" name="_token" value='{{ csrf_token() }}'>
            </form>
            <form action="deleteplaylist" method="POST" id="deleteForm" role="form">
                <input type="hidden" name="_token" value='{{ csrf_token() }}'>
            </form>
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <th>Edit Track</th>
                <th>PlayList Name</th>
                <th>Play Track</th>
                <th>Delete Track</th>
                </thead>
                @foreach($data as $playlist)
                <tr>
                    <td>
                        <a href="{{ "editplaylist/".$playlist->id }}" class="form-control btn btn-warning" name="edit">show/edit</a>
                    </td>
                    <td>{{ $playlist->playlist_name }}</td>
                    <td><audio controls> <source src="horse.ogg" type="audio/ogg"><source src="horse.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio></td>
                    <td><button type="submit" class="form-control btn btn-danger" id="{{ "delete".$playlist->id }}" name="delete" value="{{ $playlist->id }}" form="deleteForm">delete</button></td>
                </tr>
                @endforeach
            </table>
            <div class="row">
                <div class="col-md-2">
                    <a class="form-control btn btn-success" id="create_new" name="create" href="createplaylist" value="Create a new playlist">Create a new playlist</a>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection