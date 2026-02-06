<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistSongsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playlist_songs', function(Blueprint $table)
		{
			//
			$table->integer('playlist_id')->unsigned();
			$table->foreign('playlist_id')->references('id')->on('playlists');
			$table->integer('track_id')->unsigned();
			$table->foreign('track_id')->references('band_id')->on('music');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('playlist_songs', function(Blueprint $table)
		{
			//
		});
	}

}
