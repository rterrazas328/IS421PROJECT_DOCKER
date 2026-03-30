<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bands';



    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'total_followers', 'band_name', 'active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
