@extends('myapp')

@section('content')
	<section>
		<div class="container-fluid">
			<div class="jumbotron">
				<h1  class="text-info" align="center">MyUsic</h1>
				<div class="col-md-1">
					{{"Welcome ".Auth::user()['user']}}
					<a class="navbar-brand " href="#"></a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4" style="background-color:#696969;">
					<br>

					<div class="col-md-10 col-md-offset-1">
						<a href="profile" class="thumbnail" >
							@if( !isset($profile_picture))
								<img class="img-responsive" src="/img/icon.png" alt="">
							@else
								<img class="avatar" src="/image" />
							@endif
						</a>
						<strong class="name"></strong>
						<span class="button following">Following</span>
						<br>
						<br>
						<button type="button" class="btn btn-primary"><a href="/playlists">Playlists</a></button>
						<br>
						<br>
						<button type="button" class="btn btn-danger"><a href="/tracks">Tracks</a></button>
						<br>
						<br>
					</div>
					<br>
				</div>
				<div class="col-sm-6" style="background-color:;">
					<h2>My Tracks</h2>
					<table class="table table-condensed">
						<thead>
						</thead>
						<tr>
							<th>Artist/Band</th>
							<th>Track Name</th>
							<th>Genre</th>
						</tr>
						<tr>
							<td><a href="PlayListSongs.html">Jay Z</td>
							<td>Roc Boys</td>
							<td>Hip Hop</td>
							<td><audio controls> <source src="horse.ogg" type="audio/ogg"><source src="horse.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio></td>
						</tr>
						<tr>
							<td><a href="PlayListSongs.html">Jay Z</a></td>
							<td>Pound Cake</td>
							<td>Hip Hop</td>
							<td><audio controls> <source src="/music/vas.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection