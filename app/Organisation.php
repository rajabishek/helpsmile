<?php

namespace Helpsmile;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['name','subdomain'];

	/**
	 * An organisations has many users.
	 *
	 * @return mixed
	 */
	public function users()
    {
        return $this->hasMany('Helpsmile\User');
    }

    /**
	 * An organisations has many webhooks.
	 *
	 * @return mixed
	 */
	public function webhooks()
    {
        return $this->hasMany('Helpsmile\Webhook');
    }

    /**
	 * An orgabisation has many donors.
	 *
	 * @return mixed
	 */
	public function donors()
    {
        return $this->hasMany('Helpsmile\Donor');
    }

    /**
	 * An organisation receives many donations.
	 *
	 * @return mixed
	 */
	public function donations()
    {
        return $this->hasManyThrough('Helpsmile\Donation','Helpsmile\Donor');
    }
}
