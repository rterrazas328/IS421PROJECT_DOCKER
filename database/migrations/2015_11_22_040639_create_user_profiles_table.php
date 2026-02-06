<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profiles', function(Blueprint $table)
		{
			//['address', 'city', 'state', 'country', 'birthdate', 'phone', 'profile_picture', 'about_me']
			$table->integer('id')->unsigned();
			$table->foreign('id')->references('id')->on('users');
			$table->string('address');
			$table->string('city');
			$table->string('state');
			$table->string('country');
			$table->date('birthdate');
			$table->string('phone');
			$table->string('profile_picture');
			$table->text('about_me');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_profiles');
	}

}
