<?php

namespace Helpsmile;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['address','location','latitude','longitude'];

	/**
	 * An address belongs to a donation associated with the donation_id
	 *
	 * @return mixed
	 */
	public function address()
    {
        return $this->belongsTo('Helpsmile\Address');
    }
}
