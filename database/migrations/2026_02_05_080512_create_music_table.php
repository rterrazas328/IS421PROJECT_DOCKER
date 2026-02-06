<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('music', function(Blueprint $table)
		{
			//['band_id', 'song_name', 'authors', 'genre', 'file_path'];
			$table->increments('band_id');
			$table->string('song_name');
			$table->string('authors');
			$table->string('genre');
			$table->string('file_path');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('music');
	}

}
