<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

	//model for user_profiles table

    protected $table = 'user_profiles';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['address', 'city', 'state', 'country', 'birthdate', 'phone', 'profile_picture', 'about_me'];

}
