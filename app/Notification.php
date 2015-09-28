<?php

namespace Helpsmile;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['title','description','type','happened_at'];

	/**
	 * Return these fields from the database as \Carbon\Carbon instances
	 *
	 * @return array
	 */
	public function getDates()
	{
	    return array('created_at','updated_at','happened_at');
	}

	 /**
	 * A notification is shown for many users.
	 *
	 * @return mixed
	 */
	public function users()
    {
        return $this->belongsToMany('Helpsmile\User');
    }
}
