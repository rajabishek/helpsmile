<?php

namespace Helpsmile;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['fullname','email','mobile'];

	/**
	 * A donor has many donations.
	 *
	 * @return mixed
	 */
	public function donations()
    {
        return $this->hasMany('Helpsmile\Donation');
    }

    /**
	 * A donor belongs to an organisation.
	 *
	 * @return mixed
	 */
	public function organisation()
    {
        return $this->belongsTo('Helpsmile\Organisation');
    }
}
